<?php

use App\Http\Controllers\ReturningProductController;
use Illuminate\Support\Facades\Route;
//======= Use A Frontend Controller =======*/
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\AttributeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\UserController;
//use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\NagadController;
use App\Http\Controllers\Frontend\BkashController;
use App\Http\Controllers\Frontend\AamarpayController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Frontend\OrderController;
//use App\Http\Controllers\Backend\CompareController;
use App\Http\Controllers\Frontend\PublicSslCommerzPaymentController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\ReturnRequestController;
use App\Http\Controllers\Backend\Shipping\RedxController;
use App\Http\Controllers\Backend\Shipping\PathaoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*================== Frontend All Route ==============*/
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/home2', [FrontendController::class, 'index2'])->name('home2');
// Route::get('/shop-grid', [FrontendController::class, 'shopgrid'])->name('shop.grid');
Route::get('/verify',[UserController::class, 'showVerifyCode'])->name('verify.code');
Route::post('/verify-code', [UserController::class, 'verifyCode'])->name('verify.code.post');
Route::post('/resend-code', [UserController::class, 'resendCode'])->name('resend.code');
Route::get('forget-password',[UserController::class,'forgetPassword'])->name('forget.password');
Route::post('send-password',[UserController::class,'sendPassword'])->name('send.password');
Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/dashboard',[UserController::class, 'index'])->name('dashboard');
    Route::get('/get-returning-product/{id}',[UserController::class, 'getReturningProduct'])->name('get-returning-product');
});

Route::get('/refresh-csrf', function() {
    return csrf_token();
});

/* ==================== Start User dashboard Route ================== */
// Route::get('/dashboard',[UserController::class, 'index'])->name('dashboard')->middleware('web');

/* ====================  User Order Route ================== */
Route::get('/user/orders/{invoice_no}',[UserController::class, 'orderView'])->name('order.view');
Route::get('/user/orders/download/{invoice_no}',[UserController::class, 'orderDownload'])->name('order.download');
/* ==================== End User dashboard Route ================== */


/*================== Multi Language All Routes ==============*/
Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

// All Category List start
Route::get('/categories',[CategoryController::class, 'index'])->name('category_list.index');
// All Category List end


/* =============== Product Search  ============= */
Route::get('/product/suggestions', [FrontendController::class, 'searchSuggestions'])->name('product.suggestions');

Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
/* =============== Advance Search ============= */
Route::get('search-product', [FrontendController::class, 'advanceProduct']);

/* =============== Hot Deals  ============= */
Route::get('/hot-deals', [FrontendController::class, 'hotDeals'])->name('hot_deals.all');


/* ===============  Category Wise Product Show  ============= */
Route::get('/category-product/{slug}',[FrontendController::class, 'CatWiseProduct'])->name('product.category');

/* ===============  Vendor Wise Product Show  ============= */
Route::get('/vendor-product/{slug}',[FrontendController::class, 'VendorWiseProduct'])->name('vendor.product');

/* ===============  Tag Wise Product Show  ============= */
Route::get('/tag-product/{id}/{slug}',[FrontendController::class, 'TagWiseProduct'])->name('product.tag');
/* =============== Product Details Show ============= */
Route::get('product-details/{slug}',[FrontendController::class, 'productDetails'])->name('product.details');

// Page Setting

Route::get('/contact-us',[FrontendController::class, 'pageContact'])->name('page.contact');
Route::get('/about-us',[FrontendController::class, 'pageAbout'])->name('page.about');
Route::get('/terms-and-conditions',[FrontendController::class, 'pageTerms'])->name('page.terms');
Route::get('/privacy-policy',[FrontendController::class, 'pagePolicy'])->name('page.policy');
Route::get('/faq',[FrontendController::class, 'pageFaq'])->name('page.faq');
Route::get('/help',[FrontendController::class, 'pageHelp'])->name('page.help');
Route::get('/shipping&return',[FrontendController::class, 'shippingReturn'])->name('page.shipping-return');
// Route::get('/page/{slug}',[FrontendController::class, 'pageAbout'])->name('page.about');


Route::post('/message/send',[UserMessageController::class, 'submit'])->name('message.submit');
Route::get('/ordertracking',[FrontendController::class, 'orderTracking'])->name('order.tracking');
Route::get('/order-track',[FrontendController::class, 'orderTrack'])->name('order.track');

//order return request module
//Route::get('order/return/{invoice_no}/{slug}', [ReturnRequestController::class, 'index'])->name('order.return');
//Route::post('order/return/submit', [ReturnRequestController::class, 'submit'])->name('order.return.submit');
//Route::get('order/return/check/{id}', [ReturnRequestController::class, 'check'])->name('order.return.check');
//Route::get('get-product-by-id', [OrderController::class, 'getProductById'])->name('get-product-by-id');

Route::get('order/return/{invoice_no}', [ReturnRequestController::class, 'index'])->name('order.return');
Route::post('order/return/submit', [ReturnRequestController::class, 'submit'])->name('order.return.submit');
Route::get('order/return/check/{id}', [ReturnRequestController::class, 'check'])->name('order.return.check');
Route::get('get-product-by-id', [OrderController::class, 'getProductById'])->name('get-product-by-id');


/* =============== Start Product View Modal With Ajax ============== */
Route::get('/product/view/modal/{id}',[FrontendController::class,'ProductViewAjax']);
/* ============ Start Add To Cart Store Data Withn Ajax  ============= */
Route::POST('/cart/data/store/{id}',[CartController::class, 'AddToCart'])->name('cart.add');
/* ============ Start Mini Cart With Ajax  ============= */
Route::get('/product/mini/cart',[CartController::class,'AddMiniCart'])->name('minicart.add');
Route::get('/minicart/product-remove/{rowId}',[CartController::class,'RemoveMiniCart'])->name('minicart.remove');

Route::get('/login-status/check', [FrontendController::class, 'loginCheck'])->name('login.check');

/* ============ Cart Show   ============= */
Route::get('/cart',[CartController::class,'index'])->name('cart.show');
/* ============ Cart Clear   ============= */
Route::get('/cart-clear', [CartController::class, 'clearCart']);
/* ============ Cart Get Product   ============= */
Route::get('/get-cart-product', [CartController::class, 'getCartProduct'])->name('getcart.product');
/* ============  Cart Increment  ============= */
Route::get('/cart-increment/{rowId}', [CartController::class, 'cartIncrement'])->name('cart.decrement');
/* ============  Cart Decrement  ============= */
Route::get('/cart-decrement/{rowId}', [CartController::class, 'cartDecrement'])->name('cart.decrement');
/* ============ Cart Remove   ============= */
Route::get('/cart-remove/{rowId}', [CartController::class, 'removeCartProduct'])->name('cart.remove');
/* ============ All Cart Remove   ============= */
// Route::get('/cart/all-delete',[CartController::class,'destroy'])->name('cart.remove.all');
Route::post('/cart-destroy', [CartController::class, 'destroy'])->name('cart.destroy');
/* ============  Cart Checkout   ============= */
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('/checkout/payment',[CheckoutController::class,'payment'])->name('checkout.payment');
/* ============ Cart Checkout Product   ============= */
Route::get('/checkout-product', [CheckoutController::class, 'getCheckoutProduct'])->name('checktout.product');
/* ============  Checkout Store   ============= */
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
Route::get('/checkout/success/{id}',[CheckoutController::class,'show'])->name('checkout.success');

Route::get('/checkout/shipping/ajax/{shipping_cost}',[CheckoutController::class,'shippingAjax'])->name('checkout.shippingAjax');

/*================  Ajax  ==================*/
Route::get('/division-district/ajax/',[CheckoutController::class,'getdivision'])->name('division.ajax');
//Route::get('/division-district/ajax/{division_id}',[CheckoutController::class,'getdivision'])->name('division.ajax');
Route::get('/district-upazilla/ajax/',[CheckoutController::class,'getupazilla'])->name('upazilla.ajax');
/*================  Ajax  ==================*/

/* ============  All Product Show   ============= */
Route::get('/product/shop',[ProductController::class,'index'])->name('product.show');
/* =============== sort_by  ============= */

/* ============  All Product Show   ============= */
Route::get('/campaign/product',[ProductController::class,'campaignProducts'])->name('campaign.product');
/* =============== sort_by  ============= */

Route::get('/search', [ProductController::class, 'sort_by'])->name('sort_by.search');
// Attribute Data fetch
Route::get('/attribute-data',[AttributeController::class,'index'])->name('attribute.index');

//============ User Set Default Start ============//
Route::resource('/user', UserController::class);
Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
// User Dashboard
Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user-passwordupdate');
//=========== User Addresses all Route Start ============//
Route::post('/user/address/store', [UserController::class, 'store'])->name('user.address.store');
/*================  Ajax Brand Store ==================*/
Route::post('/address/store/',[UserController::class,'getAddressStore'])->name('address.ajax.store');

Route::get('user/addresses/delete/{id}', [UserController::class, 'address_destroy'])->name('user.addresses.destroy');
// Set_Default Show //
Route::get('/addresses/set_default/{id}', [UserController::class, 'set_default'])->name('addresses.set_default');
// Address Realtionship Division/District/Upazilla Show Data Ajax //
Route::get('/address/ajax/{address_id}',[UserController::class,'getAddress'])->name('address.ajax');
//=========== User Addresses all Route End ============//

Route::get('/varient-price/{id}/{varient}',[ProductController::class, 'getVarient'])->name('varient.price');

//============ User Set Default Start ============//

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//Nagad
Route::get('/nagad/callback', [NagadController::class, 'verify'])->name('nagad.callback');

// bKash
Route::post('/bkash/createpayment', [BkashController::class, 'checkout'])->name('bkash.checkout');
Route::post('/bkash/executepayment', [BkashController::class, 'excecute'])->name('bkash.excecute');
Route::get('/bkash/success', [BkashController::class, 'success'])->name('bkash.success');
Route::get('/payment/error', [BkashController::class, 'error'])->name('bkash.error');

// sslcommerz
Route::get('/sslcommerz/pay', [PublicSslCommerzPaymentController::class, 'index']);
Route::POST('/sslcommerz/success', [PublicSslCommerzPaymentController::class, 'success']);
Route::POST('/sslcommerz/fail', [PublicSslCommerzPaymentController::class, 'fail']);
Route::POST('/sslcommerz/cancel', [PublicSslCommerzPaymentController::class, 'cancel']);
Route::POST('/sslcommerz/ipn', [PublicSslCommerzPaymentController::class, 'ipn']);

//aamarpay
Route::post('/aamarpay/success', [AamarpayController::class, 'success'])->name('aamarpay.success');
Route::post('/aamarpay/fail', [AamarpayController::class, 'fail'])->name('aamarpay.fail');

//Subscribers
Route::POST('/subscribers/store', [SubscriberController::class, 'store'])->name('subscribers.store');

// Compare
Route::post('/become-a-seller', [FrontendController::class, 'becomeaseller'])->name('become.a.seller');

Route::get('/compare', 'CompareController@index')->name('compare');
Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');

Route::get('/contact',[ContactController::class, 'index'])->name('contact.index');
Route::post('/creat-contact',[ContactController::class, 'newcontact'])->name('new-contact');
Route::post('/apply-coupon',[FrontendController::class, 'applycoupon'])->name('apply-coupon');


Route::get('/load-more-products',[FrontendController::class, 'loadMoreProducts']);
//Route::get('/order/summary/download',[FrontendController::class, 'loadMoreProducts']);
// Route::post('/pages/store/{id}', [FrontendController::class, 'pagesstore'])->name('pages.store');

//order cancellation
Route::post('order/cancel', [OrderController::class, 'update_delivery_status'])->name('order.cancel.submit');

Route::get('order/review/check/{order_id}', [OrderController::class, 'productReviewAdd'])->name('order.review.check');
Route::get('product/review/{order_id}', [OrderController::class, 'productReview']);

Route::post('product/review/submit', [OrderController::class, 'submit'])->name('product.review.submit');

//RedX
Route::get('redx/get-areas', [RedxController::class, 'getAreas'])->name('redx.getAreas');
Route::get('redx/get-pickup-stores', [RedxController::class, 'getPickupStores'])->name('redx.getPickupStores');

//Pathao
Route::get('pathao/get-pickup-stores', [PathaoController::class, 'getPickupStores'])->name('pathao.getPickupStores');
Route::get('pathao/get-cities', [PathaoController::class, 'getCities'])->name('pathao.getCities');
Route::get('pathao/get-zones/{cityId}', [PathaoController::class, 'getZones'])->name('pathao.getZones');
Route::get('pathao/get-areas/{zoneId}', [PathaoController::class, 'getAreas'])->name('pathao.getAreas');



require __DIR__.'/auth.php';
