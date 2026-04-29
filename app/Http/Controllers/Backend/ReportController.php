<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Vendor;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index(Request $request)
//     {
//         // dd($request->all());
//         $sort_by =null;
//         $products = Product::orderBy('created_at', 'desc');
// //        $products = Product::orderBy('created_at', 'desc')->where('vendor_id', Auth::guard('admin')->user()->id);

//         if(Auth::guard('admin')->user()->role == '2'){
//             $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
//             if($vendor){
//                 $products = Product::where('vendor_id', $vendor->id)->latest();
//             }
//             if ($request->has('category_id') && $request->category_id > 0){
//                 $sort_by = $request->category_id;
//                 $products = $products->where('category_id', $sort_by);
//             }
//             $products = $products->paginate(20);

//         }else{
//             if ($request->has('category_id') && $request->category_id > 0){
//                 $sort_by = $request->category_id;
//                 $products = $products->where('category_id', $sort_by);
//             }
//             $products = $products->paginate(20);
//         }

// //        return $products;
//         // dd($products);
//         return view('backend.reports.index', compact('products'));
//     }
public function index(Request $request)
{
    $products = Product::query()->orderBy('created_at', 'desc')->with('stocks');

    if (Auth::guard('admin')->user()->role == '2') {
        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        if ($vendor) {
            $products = $products->where('vendor_id', $vendor->id);
        }
    }

    if ($request->filled('category_id') && $request->category_id > 0) {
        $products = $products->where('category_id', $request->category_id);
    }

    if ($request->filled('select_type')) {
        if ($request->select_type == "low") {
            $products = $products->whereColumn('stock_qty', '<=', 'low_stock');
        }
    }

    $products = $products->paginate(50);

    return view('backend.reports.index', compact('products'));
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
     * @param  int  $id
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

    public function salesReport()
    {
        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        $orders = OrderDetail::where('vendor_id', $vendor->id)->select('order_id')->selectRaw('COUNT(product_id) as product, SUM(qty) as qty')->groupBy('order_id')->get();
//        return $orders;
//        $orders = OrderDetail::where('vendor_id', $vendor->id)->get();
        return view('backend.reports.sales_report', compact('orders'));
    }
    public function details($id)
    {
        $order = Order::find( $id);
        return view('backend.reports.details', compact('order'));
    }
}
