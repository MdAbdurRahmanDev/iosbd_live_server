<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Campaing;
use DateTime;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Start Shop Product //
        $product = Product::orderBy('name_en', 'ASC')->where('status', 1)->latest();

        if(isset($_GET['stock']) && $_GET['stock'] > 0){
            $product = $product->where('stock_qty', '>', 0);
        }
        if(isset($_GET['category']) && $_GET['category'] > 0){
            $cat_id = array();
            foreach ($_GET['category'] as $cat_name){
                $category = Category::where('name_en', $cat_name)->first();
                if ($category){
                    array_push($cat_id, $category->id);
                }
            }
            $product = $product->whereIn('category_id',$cat_id);
        }
        if(isset($_GET['brand']) && $_GET['brand'] > 0){
            $brand_id = array();
            foreach ($_GET['brand'] as $brand_name){
                $brand = Brand::where('name_en', $brand_name)->first();
                if ($brand){
                    array_push($brand_id, $brand->id);
                }
            }
//            return $brand_id;
            $product = $product->whereIn('brand_id',$brand_id);
        }

        $products = $product->paginate(30);
        return view('FrontEnd.product.shop', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $varient
     * @return \Illuminate\Http\Response
     */
    public function getVarient($id, $varient)
    {
        $stock = ProductStock::where('product_id', $id)->where('varient', $varient)->first();
        if($stock){
            return $stock;
        }else{
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function campaignProducts()
    {
        $campaign = Campaing::where('status', 1)->orWhere('is_featured', 1)->orderBy('id', 'desc')->first();
        // return view('FrontEnd.campaign.index', compact('campaign'));

        // $campaign = Campaing::where('status', 1)->where('is_featured', 1)->orderBy('id', 'desc')->first();

    if ($campaign && $this->isCampaignActive($campaign)) {
        return view('FrontEnd.campaign.index', compact('campaign'));
    } else {
        return abort(404);
    }
    }

    protected function isCampaignActive($campaign)
    {
    $flashEnd = date_create($campaign->flash_end);
    $now = new DateTime();

    return $flashEnd > $now;
    }
}
