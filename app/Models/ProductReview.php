<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    public function product_review_images()
    {
        return $this->hasMany(ProductReviewImage::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
