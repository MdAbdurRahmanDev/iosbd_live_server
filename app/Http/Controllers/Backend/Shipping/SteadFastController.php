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
use Http;

class SteadFastController extends Controller
{
    private $base_url = 'https://portal.steadfast.com.bd/api/v1';
    
    public function bulkCreateInit($ids){

        $orders = Order::whereIn('id', $ids)->get();
        
        $data = array();
        
        foreach($orders as $order){
            $item = [
                'invoice' => $order->invoice_no,
                'recipient_name' => $order->name ? $order->name : 'N/A',
                'recipient_address' => $order->address ? $order->address : 'N/A',
                'recipient_phone' => $order->phone ? $order->phone : '',
                'cod_amount' => $order->grand_total,
                'note' => $order->shipping_instructions ? $order->shipping_instructions : '',
            ];
            
            array_push($data, $item);
        }
        
        
        //$steadfast = new Steadfast();
        $result = $this->bulkCreate(json_encode($data));
        
        return $result;
    
    }



    public function bulkCreate($data){
        $api_key = '5p9lmqnowajft1ja70ombppk0ggydges ';
        $secret_key = 'qfcowaitmwxcd7lsnw11luq2 ';
    
        $response = Http::withHeaders([
            'Api-Key' => $api_key,
            'Secret-Key' => $secret_key,
            'Content-Type' => 'application/json'
        ])->post($this->base_url.'/create_order/bulk-order', [
    
            'data' => $data,
    
        ]);
    
        return json_decode($response->getBody()->getContents());
    }

}