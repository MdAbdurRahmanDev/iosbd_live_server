<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function unit(){
    	return $this->belongsTo(Unit::class,'unit_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }

    public function group_product()
    {
        return $this->hasMany(GroupProduct::class, 'id', 'product_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function product_review_aggregates()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')
                    ->selectRaw('product_id, COUNT(*) as review_count, SUM(rating) as total_rating')
                    ->groupBy('product_id');
    }

}
