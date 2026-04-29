<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;

class ReturningProduct extends Model
{
    use HasFactory;
    private static $product;

    public static function add($returnRequest, $request, $ordered_product_id)
    {
//        dd(count($request->product_id));
//        if(count($request->product_id) == 1)
//        {
//            self::$product = new ReturningProduct();
//            self::$product->request_id = $returnRequest->id;
//            self::$product->product_id = $request->product_id[$i];
//            self::$product->qty = $request->qty[$i];
//            self::$product->issue = $request->issue[$i];
//            self::$product->image = self::imageUrl($request->image[$i]);
//            self::$product->save();
//        }
        for ($i=0; $i<count($request->product_id); $i++){
            $product_id = OrderDetail::find($request->product_id[$i]);
            self::$product = new ReturningProduct();
            self::$product->request_id = $returnRequest->id;
            self::$product->product_id = $product_id->product_id;
            self::$product->ordered_product_id = $request->product_id[$i];
            self::$product->qty = $request->qty[$i];
            self::$product->issue = $request->issue[$i];
            self::$product->image = self::imageUrl($request->image[$i]);
            self::$product->save();
            if(count($request->product_id) == 1){
                break;
            }
        }
    }
    private static function imageUrl($image)
    {
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/return-product/'.$make_name);
        $uploadPath = 'upload/return-product/'.$make_name;
        return $uploadPath;
    }

    public static function updateStatus($request)
    {
        $returning_products = ReturningProduct::where('request_id', $request->request_id)->get();
        foreach($returning_products as $key=>$item){
            if($item->issue == 'damaged_product' && $request->status[$key] == 1){
                reduceStock($item);
            }
            $item->status = $request->status[$key];
            $item->save();
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
