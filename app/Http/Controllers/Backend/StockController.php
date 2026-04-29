<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request->delivery_status == 'all_stock') {
            $products = Product::paginate(50);
        } elseif ($request->delivery_status == 'low') {
            $products = Product::whereColumn('stock_qty', '<=', 'low_stock')->paginate(50);
            // dd($products);
        }
        dd($products);
        return view('backend.reports.index', compact('products'));
    }


}
