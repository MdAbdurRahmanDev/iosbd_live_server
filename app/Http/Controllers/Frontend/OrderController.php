<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductReview;
use App\Models\ProductReviewImage;
use Illuminate\Support\Facades\Session;
use Auth;

class OrderController extends Controller
{
	/* ============ User Orders ============== */
    public function index()
    {
       $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
       // dd($orders);
       return view('dashboard', compact('orders'));
    } // end method
    public function getProductById()
    {
//        $data['order_id'] = $_GET['order_id'];
//        $data['product'] = $_GET['product_id'];
//        return response($data);
        $product = OrderDetail::find($_GET['product_id']);
        return response()->json($product);
    }

    public function productReviewAdd($id)
    {
        $orderDetails = OrderDetail::where('order_id', $id)->get();

        return response()->json(['orderDetails' =>$orderDetails] );
    }

    public function productReview($id)
    {
        if (Auth::check() && Auth::user()->role == 3) {
            $reviewedProductIds = ProductReview::where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
            $products = OrderDetail::where('order_id',$id)->whereNotIn('product_id', $reviewedProductIds)->get();

            return view('FrontEnd.review.index', compact('products'));
        } else {
            return redirect()->back();
        }
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        $userId = Auth::user()->id;
        $user_name = Auth::user()->name;

        $request->validate([
            'rating' => 'required|array',
            'rating.*' => 'required|integer|min:1|max:5',
        ]);

        if ($request->has('order_detail_id')) {
            foreach ($request->order_detail_id as $index => $orderDetailId) {

                $productReview = new ProductReview();
                $productReview->user_id = $userId;
                $productReview->user_name = $user_name;
                $productReview->order_detail_id = $orderDetailId;
                $productReview->product_id = $request->product_id[$index];
                $productReview->rating = $request->rating[$orderDetailId];
                $productReview->review = $request->review_product[$orderDetailId];
                $productReview->save();

                if (isset($request->file('image')[$orderDetailId]) && is_array($request->file('image')[$orderDetailId])) {
                    foreach ($request->file('image')[$orderDetailId] as $image) {
                        if ($image->isValid()) {
                            $imageName = time() . "_" . $orderDetailId . "_" . uniqid() . "." . $image->getClientOriginalExtension();
                            $image->move(public_path('uploads/productReview'), $imageName);
                            $imageUrl = 'uploads/productReview/' . $imageName;

                            $productReviewImage = new ProductReviewImage();
                            $productReviewImage->product_review_id = $productReview->id;
                            $productReviewImage->image = $imageUrl;
                            $productReviewImage->save();
                        }
                    }
                }


            }

            $notification = array(
                'message' => 'Product Review and Images Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('dashboard')->with($notification);

        } else {
            $notification = array(
                'message' => 'Product Reviews were not created.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

}


