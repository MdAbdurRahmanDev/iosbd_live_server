<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductStock;
use App\Models\CategorySpecification;
use App\Models\ProductSpecification;
use App\Models\GroupProduct;
use App\Models\Unit;
use Carbon\Carbon;
use Image;
use Session;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Collection;
use DB;

class ProductController extends Controller
{
    /*=================== Start ProductView Methoed ===================*/
    public function ProductView(){
    	if(Auth::guard('admin')->user()->role == '2'){
//            $products = Product::where('vendor_id', Auth::guard('admin')->user()->id)->latest()->get();
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            if($vendor){
                $products = Product::where('vendor_id', $vendor->id)->latest()->get();
            }
        }else{
            $products = Product::latest()->get();
        }
        return view('backend.product.product_view',compact('products'));

    } // end method

    /*=================== Start ProductAdd Methoed ===================*/
    public function ProductAdd(){
        // Session::put('a', 0);
    	$categories = Category::where('parent_id', 0)->with('childrenCategories')->orderBy('name_en','asc')->get();
		$brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
    	return view('backend.product.product_add',compact('categories','brands','vendors','suppliers','attributes','units'));

    } // end method

    /*=================== Start StoreProduct Methoed ===================*/
    public function StoreProduct(Request $request){
//         return $request;
// dd($request->all());
        $request->validate([
            'name_en'               => 'required|max:150',
            'product_code'          => 'required|max:150',
            'regular_price'         => 'required|numeric',
            'short_description_en'  => 'nullable|string',
            'description_en'        => 'required|string',
            'category_id'           => 'required|integer',
            'brand_id'              => 'nullable|integer',
            'stock_qty'             => 'required|integer',
            'purchase_price'        => 'required|numeric',
            'discount_price'        => 'nullable|numeric',
            'product_thumbnail'     => 'required',
        ]);

        if(!$request->name_bn){
            $request->name_bn = $request->name_en;
        }

        if(!$request->description_bn){
            $request->description_bn = $request->description_en;
        }

        // $slug = strtolower(str_replace(' ', '-', $request->name_en));
        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
        }

        if($request->category_id == null || $request->category_id==""){
            $request->category_id = 0;
        }

        if($request->regular_price == null || $request->regular_price==""){
            $request->regular_price = 0;
        }

        if($request->vendor_id == null || $request->vendor_id==""){
            $request->vendor_id = 0;
        }
        if($request->brand_id == null || $request->brand_id==""){
            $request->brand_id = 0;
        }
        if($request->points == null || $request->points==""){
            $request->points = 0;
        }

        if($request->supplier_id == null || $request->supplier_id==""){
            $request->supplier_id = 0;
        }

        if($request->unit_id == null || $request->unit_id==""){
            $request->unit_id = 0;
        }

        if($request->hasfile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(438,438)->save('upload/products/thumbnails/'.$name_gen);
            $save_url = 'upload/products/thumbnails/'.$name_gen;
        }else{
            $save_url = '';
        }

            $product = Product::create([
                'brand_id'              => $request->brand_id,
                'product_type'           => $request->product_type,
                'category_id'           => $request->category_id,
                'vendor_id'             => $request->vendor_id,
                'supplier_id'           => $request->supplier_id,
                'unit_id'               => $request->unit_id,
                'name_en'               => $request->name_en,
                'name_bn'               => $request->name_bn,
                'slug'                  => $slug,
                'unit_weight'           => $request->unit_weight,
                'purchase_price'        => $request->purchase_price,
                'wholesell_price'       => $request->wholesell_price,
                'wholesell_minimum_qty' => $request->wholesell_minimum_qty,
                'regular_price'         => $request->regular_price,
                'discount_price'        => $request->discount_price ?? 0,
                'discount_type'         => $request->discount_type,
                'product_code'          => $request->product_code,
                'minimum_buy_qty'       => 1,
                'stock_qty'             => $request->stock_qty,
                'low_stock'             => $request->low_stock,
                'short_description_en'  => $request->short_description_en,
                'short_description_bn'  => $request->short_description_bn,
                'description_en'        => $request->description_en,
                'description_bn'        => $request->description_bn,
                'is_featured'           => $request->is_featured ? 1 : 0,
                'is_replaceable'        => $request->is_replaceable ? 1 : 0,
                'is_deals'              => $request->is_deals ? 1 : 0,
                'is_digital'            => $request->is_digital ? 1 : 0,
                'status'                => $request->status ? 1 : 0,
                'points'                => $request->points,
                'product_thumbnail'     => $save_url,
                'created_by'            => Auth::guard('admin')->user()->id,
            ]);

        // category wise multiple Specification

        $data = [];
        if($request->has('featured')){
            foreach ($request->featured as $featured_id => $value) {
                $cleanValue = trim($value);
                if ($cleanValue === '') continue;
    
                $data[] = [
                    'product_id' => $product->id,
                    'specification_id' => $featured_id,
                    'value' => $cleanValue,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ProductSpecification::insert($data);




        // dd($product);

        /* ========= Start Multiple Image Upload ========= */
        $images = $request->file('multi_img');
        if($images){
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
                $uploadPath = 'upload/products/multi-image/'.$make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        /* ========= End Multiple Image Upload ========= */

        /* ========= Product Attributes Start ========= */
        $attribute_values = array();
        if($request->has('choice_attributes')){
            foreach ($request->choice_attributes as $key => $attribute)
            {
                $atr = 'choice_options'.$attribute;
                $item['attribute_id'] = $attribute;
                $data = array();

                foreach ($request[$atr] as $key => $value) {
                    array_push($data, $value);
                }

                $item['values'] = $data;
                array_push($attribute_values, $item);
            }
        }

        if (!empty($request->choice_attributes)) {
            $product->attributes = json_encode($request->choice_attributes);
            $product->is_varient = 1;

            if($request->has('vnames')){
                $i = 0;
                foreach ($request->vnames as $key => $name){
                    $stock = ProductStock::create([
                        'product_id' => $product->id,
                        'varient'    => $name,
                        'sku'        => $request->vskus[$i],
                        'price'      => $request->vprices[$i],
                        'qty'        => $request->vqtys[$i],
                    ]);

                    $image = $request->vimages[$i];
                    if($image){
                        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                        Image::make($image)->resize(438,438)->save('upload/products/variations/'.$name_gen);
                        $save_url = 'upload/products/variations/'.$name_gen;
                    }else{
                        $save_url = '';
                    }

                    $stock->image = $save_url;
                    $stock->save();

                    $i++;
                }
            }
        }
        else {
            $product->attributes = json_encode(array());
        }

        $attr_values = collect($attribute_values);
        $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

        $sorted_array = array();
        foreach($attr_values_sorted as $attr){
            array_push($sorted_array, $attr);
        }

        $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
        /* ========= End Product Attributes ========= */

        // /* =========== Start Product Tags =========== */
        // $product->tags = implode(',', $request->tags);
        // /* =========== End Product Tags =========== */

        $product->save();

        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 1,
            'particulars' => 'Product ID: '.$product->id,
            'debit' => $product->purchase_price,
            'product_id' => $product->id,
            'type' => 1,
        ]);
        $ledger->balance = get_account_balance() - $product->purchase_price;
        $ledger->save();

        if($request->product_type == '2'){
            foreach($request->group_id as $key => $group){
                $group_product = new GroupProduct();
                $group_product -> product_id =  $product->id;
                $group_product -> group_product_id =  $group;
                $group_product -> status = $request->status ? 1 : 0;
                $group_product -> save();
            }
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    } // end method

    /*=================== Start EditProduct Methoed ===================*/
    public function duplicateProduct($id){

        $product = Product::findOrFail($id);
        // if(Auth::guard('admin')->user()->role == 2){
        //     $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        //     if ($product->vendor_id  != $vendor->id){
        //         abort(404);
        //     }
        // }

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $product->name_en)).'-'.Str::random(5);

        $newProduct = $product->replicate();
        $newProduct->slug = $slug;
        if($product->product_thumbnail && file_exists(public_path($product->product_thumbnail))) {
            $ext = pathinfo($product->product_thumbnail, PATHINFO_EXTENSION);
            $newFileName = hexdec(uniqid()) . '.' . $ext;
            $newPath = 'upload/products/thumbnails/' . $newFileName;

            // Copy and resize using Intervention Image
            Image::make(public_path($product->product_thumbnail))->save(public_path($newPath));

            $newProduct->product_thumbnail = $newPath;
        }
        $newProduct->save();

        $productStocks = ProductStock::where('product_id', $product->id)->get();
        foreach($productStocks as $productStock){
            $newProductStock = $productStock->replicate();
            $newProductStock->product_id = $newProduct->id;
            $newProductStock->save();
        }

        $multiImgs = MultiImg::where('product_id',$id)->get();
        foreach($multiImgs as $multiImg){
            $newMultiImg = $multiImg->replicate();
            $newMultiImg->product_id = $newProduct->id;
            if($multiImg->photo_name && file_exists(public_path($multiImg->photo_name))) {
                $ext = pathinfo($multiImg->photo_name, PATHINFO_EXTENSION);
                $newFileName = hexdec(uniqid()) . '.' . $ext;
                $newPath = 'upload/products/multi-image/' . $newFileName;

                // Copy and resize using Intervention Image
                Image::make(public_path($multiImg->photo_name))->save(public_path($newPath));

                $newMultiImg->photo_name = $newPath;
            }
            $newMultiImg->save();
        }

        $notification = array(
            'message' => 'Product Duplicated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
    public function EditProduct($id){

        $product = Product::findOrFail($id);
        if(Auth::guard('admin')->user()->role == 2){
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            if ($product->vendor_id  != $vendor->id){
                abort(404);
            }
        }
        $productSpecifications = ProductSpecification::where('product_id',$product->id)->get();

        $multiImgs = MultiImg::where('product_id',$id)->get();

        $categories = Category::where('parent_id', 0)->latest()->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
        
        // dd($categories);
// 
        //dd($product->stocks);

        return view('backend.product.product_edit',compact('categories','productSpecifications','vendors','suppliers','brands','attributes','product','multiImgs','units'));

    }
    // end method
    public function detailsProduct($id){

        $product = Product::findOrFail($id);

        $multiImgs = MultiImg::where('product_id',$id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();

        //dd($product->stocks);

        return view('backend.product.product_details',compact('categories','vendors','suppliers','brands','attributes','product','multiImgs','units'));

    }
    /*=================== Start ProductUpdate Methoed ===================*/
    public function ProductUpdate(Request $request, $id){
        // dd($request);
//        return $request->discount_price;
        $product = Product::find($id);

        $this->validate($request,[
            'name_en'               => 'required|max:150',
            'product_code'          => 'required|max:150',
            'purchase_price'        => 'required|numeric',
            'discount_price'        => 'nullable|numeric',
            'regular_price'         => 'required|numeric',
            'stock_qty'             => 'required|integer',
            'short_description_en'  => 'nullable|string',
            'description_en'        => 'required|string',
            'category_id'           => 'required|integer',
            'brand_id'              => 'nullable|integer',
        ]);

        if(!$request->name_bn){
            $request->name_bn = $request->name_en;
        }

        if(!$request->description_bn){
            $request->description_bn = $request->description_en;
        }

        if($request->name_en != $product->name_en){
            if ($request->slug != null) {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }else {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
            }
        }else{
            $slug = $product->slug;
        }

        if($request->vendor_id == null || $request->vendor_id==""){
            $request->vendor_id = 0;
        }

        if($request->brand_id == null || $request->brand_id==""){
            $request->brand_id = 0;
        }

        if($request->points == null || $request->points==""){
            $request->points = 0;
        }

        if($request->supplier_id == null || $request->supplier_id==""){
            $request->supplier_id = 0;
        }

        if($request->unit_id == null || $request->unit_id==""){
            $request->unit_id = 0;
        }

        if($request->hasfile('product_thumbnail')){
            try {
                if(file_exists($product->product_thumbnail)){
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {

            }
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(438,438)->save('upload/products/thumbnails/'.$name_gen);
            $save_url = 'upload/products/thumbnails/'.$name_gen;
        }else{
            $save_url = $product->product_thumbnail;
        }

        $product->update([
            'brand_id'              => $request->brand_id,
            'category_id'           => $request->category_id,
            'vendor_id'             => $request->vendor_id,
            'supplier_id'           => $request->supplier_id,
            'unit_id'               => $request->unit_id,
            'name_en'               => $request->name_en,
            'name_bn'               => $request->name_bn,
            'slug'                  => $slug,
            'unit_weight'           => $request->unit_weight,
            'purchase_price'        => $request->purchase_price,
            'regular_price'         => $request->regular_price,
            'discount_price'        => $request->discount_price ?? 0,
            'discount_type'         => $request->discount_type,
            'product_code'          => $request->product_code,
            'minimum_buy_qty'       => $request->minimum_buy_qty,
            'stock_qty'             => $request->stock_qty,
            'low_stock'             => $request->low_stock,
            'short_description_en'  => $request->short_description_en,
            'short_description_bn'  => $request->short_description_bn,
            'description_en'        => $request->description_en,
            'description_bn'        => $request->description_bn,
            'is_featured'           => $request->is_featured ? 1 : 0,
            'is_replaceable'        => $request->is_replaceable ? 1 : 0,
            'is_deals'              => $request->is_deals ? 1 : 0,
            'is_digital'            => $request->is_digital ? 1 : 0,
            'status'                => $request->status ? 1 : 0,
            'points'                => $request->points,
            'product_thumbnail'     => $save_url,
            'created_by'            => Auth::guard('admin')->user()->id,
        ]);


        // category wise multiple Specification
    
        $productId = $product->id;

        if($request->has('featured')){
            $incoming = $request->featured; 
            $existingSpecs = ProductSpecification::where('product_id', $productId)->get()->keyBy('specification_id');
            $dataToUpdateInsert = [];
            $incomingSpecIds = [];
    
            foreach ($incoming as $specId => $value) {
                $value = trim($value);
                if ($value === '') continue;
    
                $incomingSpecIds[] = $specId;
    
                $dataToUpdateInsert[] = [
                    'product_id' => $productId,
                    'specification_id' => $specId,
                    'value' => $value,
                    'updated_at' => now(),
                    'created_at' => now(),
                ];
            }
    
            ProductSpecification::upsert(
                $dataToUpdateInsert,
                ['product_id', 'specification_id'],
                ['value', 'updated_at']
            );
    
            ProductSpecification::where('product_id', $productId)
                ->whereNotIn('specification_id', $incomingSpecIds)
                ->delete();
            
        }


        /* ========= Product Previous Stock Clear ========= */
        $product_stocks = $product->stocks;
        if(count( $product_stocks) > 0 ) {
            if($request->is_variation_changed){
                foreach( $product_stocks as $stock ) {
                    // unlink($stock->image);
                    try {
                        if(file_exists($stock->image)){
                            unlink($stock->image);
                        }
                    } catch (Exception $e) {

                    }
                    $stock->delete();
                }
            }else{

                foreach( $product_stocks as $stock ) {
                    $variant = $stock->id."_variant";
                    $price = $stock->id."_price";
                    $sku = $stock->id."_sku";
                    $qty = $stock->id."_qty";
                    $image = $stock->id."_image";

                    $stock->update([
                        'sku' => $request->$sku,
                        'price' => $request->$price,
                        'qty' => $request->$qty,
                    ]);

                    if($request->hasfile($image)){
                        $photo = $request->file($image);
                        if($photo){
                            try {
                                if(file_exists($stock->image)){
                                    unlink($stock->image);
                                }
                            } catch (Exception $e) {

                            }
                        }

                        $name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
                        Image::make($photo)->resize(438,438)->save('upload/products/variations/'.$name_gen);
                        $save_url = 'upload/products/variations/'.$name_gen;

                        $stock->image = $save_url;
                        $stock->save();
                    }

                }

            }
        }

        if($request->is_variation_changed){
            /* ========= Product Attributes Start ========= */
            $attribute_values = array();
            if($request->has('choice_attributes')){
                foreach ($request->choice_attributes as $key => $attribute)
                {
                    $atr = 'choice_options'.$attribute;
                    $item['attribute_id'] = $attribute;
                    $data = array();

                    foreach ($request[$atr] as $key => $value) {
                        array_push($data, $value);
                    }

                    $item['values'] = $data;
                    array_push($attribute_values, $item);
                }
            }

            if (!empty($request->choice_attributes)) {
                $product->attributes = json_encode($request->choice_attributes);
                $product->is_varient = 1;

                if($request->has('vnames')){
                    $i = 0;
                    // dd($request);
                    foreach ($request->vnames as $key => $name){
                        $stock = ProductStock::create([
                            'product_id' => $product->id,
                            'varient'    => $name,
                            'sku'        => $request->vskus[$i],
                            'price'      => $request->vprices[$i],
                            'qty'        => $request->vqtys[$i],
                        ]);
//                        return $request->vimages[$i] ;
                        if($request->vimages){
                            $image = $request->vimages[$i];
                        }
                        else{
                            $image=0;
                        }

                        if($image){
                            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                            Image::make($image)->resize(438,438)->save('upload/products/variations/'.$name_gen);
                            $save_url = 'upload/products/variations/'.$name_gen;
                        }else{
                            $save_url = '';
                        }

                        $stock->image = $save_url;
                        $stock->save();

                        $i++;
                    }
                }
            }
            else {
                $product->attributes = json_encode(array());
                $product->is_varient = 0;
            }

            $attr_values = collect($attribute_values);
            $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

            $sorted_array = array();
            foreach($attr_values_sorted as $attr){
                array_push($sorted_array, $attr);
            }

            $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
            /* ========= End Product Attributes ========= */
        }


        /* =========== Start Product Tags =========== */
        // $product->tags = implode(',', $request->tags);
        /* =========== End Product Tags =========== */

        /* =========== Multiple Image Update =========== */

        $images = $request->file('multi_img');

        if($images == Null){
            $product->multi_imgs->photo_name = $request->multi_img;
            $product->update();
        }else{
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
                $uploadPath = 'upload/products/multi-image/'.$make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);

            }
        }

        $product->save();

        if($product->product_type == '2'){
            DB::table('group_products')->where('product_id', $product->id )->delete();

            foreach($request->group_id as $key => $group){
                $group_product = new GroupProduct();
                $group_product -> product_id =  $product->id;
                $group_product -> group_product_id =  $group;
                $group_product -> status = $request->status ? 1 : 0;
                $group_product -> save();
            }
        }

        Session::flash('success','Product Updated Successfully');
        return redirect()->route('product.all');

    } // end method
    /*=================== End ProductUpdate Methoed ===================*/

    /*=================== Start Multi Image Delete =================*/
    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        try {
            if(file_exists($oldimg->photo_name)){
                unlink($oldimg->photo_name);
            }
        } catch (Exception $e) {

        }
        MultiImg::findOrFail($id)->delete();


        return response()->json(['success'=> 'Product Deleted Successfully']);

    } // end method
    /*=================== End Multi Image Delete =================*/

    /*=================== Start ProductDelete Method =================*/
    public function ProductDelete($id){

        if(!demo_mode()){
            $product = Product::findOrFail($id);

            try {
                if(file_exists($product->product_thumbnail)){
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {

            }

            ProductSpecification::where('product_id', $product->id)->delete();

            $product->delete();

            $images = MultiImg::where('product_id',$id)->get();
            foreach ($images as $img) {
                try {
                    if(file_exists($img->photo_name)){
                        unlink($img->photo_name);
                    }
                } catch (Exception $e) {

                }
                MultiImg::where('product_id',$id)->delete();
            }
            if($product->product_type == '2') {
                DB::table('group_products')->where('product_id', $product->id)->delete();
            }

            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Product can not be deleted on demo mode.',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    } // end method
    /*=================== End ProductDelete Method =================*/

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->save();

        $notification = array(
            'message' => 'Product Active Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->save();

        $notification = array(
            'message' => 'Product Inactive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Featured Methoed ===================*/
    public function featured($id){
        $product = Product::find($id);
        if($product->is_featured == 1){
            $product->is_featured = 0;
        }else{
            $product->is_featured = 1;
        }
        $product->save();
        $notification = array(
            'message' => 'Product Feature Status Changed Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Category With SubCategory  Ajax ===================*/
    public function GetSubProductCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    } // end method

    /*=================== Start SubCategory With Childe Ajax ===================*/
    public function GetSubSubCategory($subcategory_id){
        $childe = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($childe);
    } // end method

    public function add_more_choice_option(Request $request) {
        $attributes = Attribute::whereIn('id', $request->attribute_ids)->get();
        // dd($attributes);
        return view('backend.product.attribute_select_value',compact('attributes'));
    }


    /* ============== Category Store Ajax ============ */
    public function categoryInsert(Request $request)
    {

        if($request->name_en == Null){
            return response()->json(['error'=> 'Category Field  Required']);
        }

        $category = new Category();

        $category->name_en = $request->name_en;

        /* ======== Category Name English ======= */
        $category->name_en = $request->name_en;
        if($request->name_bn == ''){
            $category->name_bn = $request->name_en;
        }else{
            $category->name_bn = $request->name_bn;
        }

         /* ======== Category Parent Id  ======= */
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);

            // dd($parent);
            $category->type = $parent->type + 1 ;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
        }

        if($request->hasfile('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen;
        }else{
            $save_url = '';
        }

        $category->image = $save_url;
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->save();

        $categories = Category::with('childrenCategories')->orderBy('name_en','asc')->get();

        return response()->json([
            'success'=> 'Category Inserted Successfully',
            'categories' => $categories,
        ]);

    }

    /* ============== Brand Store Ajax ============ */

    /* ============== Brand Store Ajax ============== */
    public function brandInsert(Request $request)
    {

        if($request->name_en == Null){
            return response()->json(['error'=> 'Brand Field  Required']);
        }

        $brand = new Brand();

        $brand->name_en = $request->name_en;

        /* ======== brand Name English ======= */
        $brand->name_en = $request->name_en;
        if($request->name_bn == ''){
            $brand->name_bn = $request->name_en;
        }else{
            $brand->name_bn = $request->name_bn;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
        }



        // dd($request->image);


        if($request->hasfile('brand_image')){
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
        }else{
            $save_url = '';
        }

        $brand->brand_image = $save_url;
        $brand->created_by = Auth::guard('admin')->user()->id;

        $brand->save();
        $brands = Brand::all();

        return response()->json([
            'success'=> 'Brand Inserted Successfully',
            'brands' => $brands,
        ]);
    }


    public function supplierInsert(Request $request)
    {
        // Validation
        if ($request->name_en == null) {
            return response()->json(['error' => 'Supplier Field Required']);
        }

        try {
            $supplier = new Supplier();
            $supplier->name = $request->name_en;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->created_by = Auth::guard('admin')->user()->id;
            $supplier->save();

            $suppliers = Supplier::all(); // Get updated list

            return response()->json([
                'success' => 'Supplier Inserted Successfully',
                'supplier' => $supplier, // Newly created supplier
                'suppliers' => $suppliers // Updated list of all suppliers
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
        //category wish Feature
    public function getCategoryFeatures($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['html' => '']);
            }

            $specifications = CategorySpecification::where('category_id',$category->id)->get();

            $html = '';

            foreach ($specifications as $specification) {
                $html .= '
                    <div class="input-group mb-2 feature-field-row">
                        <p class="me-3 mb-0 pt-2 fw-bold" style="min-width: 120px;">' . $specification->name . '</p>
                        <input type="text" name="featured[' . $specification->id . ']" class="form-control" placeholder="Enter value" />
                    </div>';
            }



            return response()->json(['html' => $html]);
        } catch (\Throwable $e) {
            // Log the error
            \Log::error('Category Features Error: ' . $e->getMessage());
            return response()->json(['html' => ''], 500);
        }
    }

            //category wish Specification edit
    public function getCategoryFeaturesEdit(Request $request)
    {
        try {
                $category = Category::find($request->c_id);
                if (!$category) {
                    return response()->json(['html' => '']);
                }

                $specifications = CategorySpecification::where('category_id', $category->id)->get();
                $specificationIds = $specifications->pluck('id')->toArray();

                $productSpecifications = ProductSpecification::where('product_id', $request->p_id)
                                            ->whereIn('specification_id', $specificationIds)
                                            ->get();

                $html = '';

                if (!empty($productSpecifications) && $productSpecifications->count() > 0) {
                    
                    foreach ($productSpecifications as $productSpecification) {
                        $html .= '
                            <div class="input-group mb-2 feature-field-row">
                                <p class="me-3 mb-0 pt-2 fw-bold" style="min-width: 120px;">' . $productSpecification->specification->name . '</p>
                                <input type="text" name="featured[' . $productSpecification->specification->id . ']" class="form-control" value="' . $productSpecification->value . '" " />
                            </div>';
                    }
                } else {
                    
                    foreach ($specifications as $specification) {
                        $html .= '
                            <div class="input-group mb-2 feature-field-row">
                                <p class="me-3 mb-0 pt-2 fw-bold" style="min-width: 120px;">' . $specification->name . '</p>
                                <input type="text" name="featured[' . $specification->id . ']" class="form-control" placeholder="Enter value" />
                            </div>';
                    }
                }

                return response()->json(['html' => $html]);

        } catch (\Throwable $e) {
            \Log::error('Category Features Error: ' . $e->getMessage());
            return response()->json(['html' => ''], 500);
        }

        }

}
