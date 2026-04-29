<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class PathaoController extends Controller
{
    private $base_url = 'https://courier-api-sandbox.pathao.com'; // Sandbox
    // private $base_url = 'https://api-hermes.pathao.com'; // Production

    public function getAccessToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->base_url . '/aladdin/api/v1/issue-token', [
            'client_id' => env('PATHAO_CLIENT_ID'),
            'client_secret' => env('PATHAO_CLIENT_SECRET'),
            'grant_type' => 'password',
            'username' => env('PATHAO_USERNAME'),
            'password' => env('PATHAO_PASSWORD'),
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        } else {
            return null; // Return null if token retrieval fails
        }
    }

    public function bulkCreateInit(Request $request, $ids)
    {
        // Get access token
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return response()->json(['message' => 'Failed to retrieve access token'], 401);
        }

        $orders = Order::whereIn('id', $ids)->get();
        $formattedOrders = array();

        $weight = intval($request->total_weight) / 1000; // Default weight

        foreach ($orders as $order) {
            $itemDescription = '';
            $order_details = $order->order_details;
            foreach ($order_details as $key => $detail) {
                if($key != (count($order_details)-1)) {
                    $itemDescription .= $detail->product->category->name_en . ', ';
                }else{
                    $itemDescription .= $detail->product->category->name_en;
                }
            }
            $item = [
                'store_id' => intval($request->pathao_store_id),
                'merchant_order_id' => $order->invoice_no,
                'recipient_name' => $order->name ?? 'N/A',
                'recipient_phone' => $order->phone ?? '',
                'recipient_address' => $order->address ?? 'N/A',
                'recipient_city' => intval($request->pathao_city_id),
                'recipient_zone' => intval($request->pathao_zone_id),
                'recipient_area' => intval($request->pathao_area_id),
                'delivery_type' => 48,
                'item_type' => 2,
                'special_instruction' => $request->shipping_instructions ?? '',
                'item_quantity' => 1,
                'item_weight' => floatval($weight),
                'amount_to_collect' => intval($order->grand_total),
                'item_description' => 'This is a Cloth item, price- 3000',
            ];
            array_push($formattedOrders, $item);
        }

        // dd($formattedOrders);

        return $this->bulkCreate($formattedOrders, $access_token);
    }

    public function bulkCreate($orders, $access_token)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=UTF-8',
        ])->post($this->base_url . '/orders/bulk', [
            'orders' => $orders,
        ]);

        // dd($response->body());

        return response()->json([
            'status' => $response->status(),
            'data' => $response->json(),
            'message' => $response->status() == 201 ? 'Bulk order created successfully!' : 'Failed to create bulk order',
        ]);
    }

    public function getPickupStores()
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return response()->json(['message' => 'Failed to retrieve access token'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=UTF-8',
        ])->get($this->base_url . '/aladdin/api/v1/stores');

        if ($response->successful()) {
            return response()->json($response->json()['data']['data']);
        } else {
            return response()->json(['message' => 'Failed to fetch stores'], $response->status());
        }
    }

    public function getCities()
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return response()->json(['message' => 'Failed to retrieve access token'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=UTF-8',
        ])->get($this->base_url . '/aladdin/api/v1/city-list');

        if ($response->successful()) {
            return response()->json($response->json()['data']['data']);
        } else {
            return response()->json(['message' => 'Failed to fetch cities'], $response->status());
        }
    }

    public function getZones($cityId)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return response()->json(['message' => 'Failed to retrieve access token'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=UTF-8',
        ])->get($this->base_url . "/aladdin/api/v1/cities/{$cityId}/zone-list");

        if ($response->successful()) {
            return response()->json($response->json()['data']['data']);
        } else {
            return response()->json(['message' => 'Failed to fetch zones'], $response->status());
        }
    }

    public function getAreas($zoneId)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return response()->json(['message' => 'Failed to retrieve access token'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json; charset=UTF-8',
        ])->get($this->base_url . "/aladdin/api/v1/zones/{$zoneId}/area-list");

        if ($response->successful()) {
            return response()->json($response->json()['data']['data']);
        } else {
            return response()->json(['message' => 'Failed to fetch areas'], $response->status());
        }
    }
}
