<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Http;

class RedxController extends Controller
{
    private $apiUrl = 'https://sandbox.redx.com.bd/v1.0.0-beta'; //Sandbox API Base URL
    // private $apiUrl = 'https://openapi.redx.com.bd/v1.0.0-beta'; //Production API Base URL
    private $apiToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxIiwiaWF0IjoxNzM1NTMxNjU2LCJpc3MiOiJ0OTlnbEVnZTBUTm5MYTNvalh6MG9VaGxtNEVoamNFMyIsInNob3BfaWQiOjEsInVzZXJfaWQiOjZ9.zpKfyHK6zPBVaTrYevnCqnUA-e2jFKQJ7lK-z4aOx2g"; // Replace with actual token

    /**
     * Create a new parcel order in RedX.
     */
    public function createParcel(Request $request, $orderId)
    {
        // dd($request);
        $this->apiUrl = $this->apiUrl.'/parcel';
        // Find the order with its details
        $order = Order::with('order_details')->findOrFail($orderId);

        // Set API Token (Replace with actual sandbox token)
        

        // Prepare parcel_details_json from OrderDetail model
        $parcelDetails = $order->order_details->map(function ($detail) {
            return [
                'name' => $detail->product->name_en, // Adjust field names based on your DB columns
                'category' => $detail->product->category->name_en, // Adjust field names based on your DB columns
                'value' => $detail->price*$detail->qty // Adjust field names based on your DB columns
            ];
        })->toArray();

        $delivery_area = explode("@#@",$request->redx_delivery_area);
        $area_id = $delivery_area[0];
        $area_name = $delivery_area[1];

        // Prepare the request payload
        $payload = [
            "customer_name" => $order->name,
            "customer_phone" => $order->phone ?? "",
            "delivery_area" => $area_name,
            "delivery_area_id" => intval($area_id),
            "customer_address" => $order->address,
            "merchant_invoice_id" => $order->invoice_no,
            "cash_collection_amount" => $order->grand_total,
            "parcel_weight" => $request->total_weight ?? 0,
            "instruction" => $request->shipping_instructions ?? "",
            "value" => $order->grand_total, // Adjust this based on the total value of the order
            "is_closed_box" => false,
            "pickup_store_id" => $request->redx_pickup_store ?? '', // Optional field
            "parcel_details_json" => $parcelDetails // OrderDetails mapped to JSON format
        ];

        try {
            // dd(json_encode($payload));
            // Send the POST request with JSON data
            $response = Http::withHeaders([
                'API-ACCESS-TOKEN' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json'
            ])->post($this->apiUrl, $payload);

            // dd($response->body());

            return $response;

            // dd($response);

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json()
                ]);
            } else {
                // Handle API errors
                return response()->json([
                    'status' => 'error',
                    'message' => $response->json()
                ], $response->status());
            }
        } catch (\Exception $e) {
            // Catch and handle exceptions
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch available delivery areas from RedX API.
     */
    public function getAreas()
    {
        try {
            // Call the API endpoint
            $response = Http::withHeaders([
                'API-ACCESS-TOKEN' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json'
            ])->get($this->apiUrl . '/areas');

            // Check if the request was successful
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json()
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $response->json()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch my pickup stores from RedX API.
     */
    public function getPickupStores()
    {
        try {
            // Call the API endpoint
            $response = Http::withHeaders([
                'API-ACCESS-TOKEN' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json'
            ])->get($this->apiUrl . '/pickup/stores');

            // Check if the request was successful
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json()
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $response->json()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}