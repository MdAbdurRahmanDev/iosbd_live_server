<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
{{--    <meta name="author" content="Themezhub" />--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset(get_setting('site_favicon')->value)}}" type="image/x-icon">
    <title> {{get_setting('site_name')->value}} | @yield('title') md rahman</title>

    <!-- Custom CSS -->
    <style>
        /* Make modal appear above header */
        .modal {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999999 !important;
            display: none;
            outline: 0;
        }
        .modal-backdrop {
            z-index: 999998 !important;
        }
        .modal-dialog {
            z-index: 999999 !important;
            margin: 5vh auto !important;
            position: relative;
        }
        .modal.fade .modal-dialog {
            transform: translate(0, 0);
        }
        .modal.show {
            display: block;
        }
        .modal-open {
            overflow: hidden;
        }
        .custom-modal .modal-content {
            border-radius: 8px;
            border: none;
            position: relative;
            z-index: 999999;
        }
    </style>

@include('FrontEnd.include.style')
 @stack('css')

</head>

<body>

<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader"></div>

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

    @include('FrontEnd.include.header')

    <div class="page-content">
        @yield('content')
    </div>
    

    @include('FrontEnd.include.footer')

    <!-- Product View Modal -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-headers">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="closeModel" aria-label="Close" >
                    <span class="ti-close"></span>
                </button>
            </div>
            <div class="modal-content ">
{{--                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" id="closeModel">Close</button>--}}
                <div class="modal-body mt-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <!-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> -->
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img id="pimage" src="" class="img-fluid" width="375" alt="product image" />
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <!-- <div class="slider-nav-thumbnails">
                                    <div><img  src="" alt="product image" /></div>
                                </div> -->
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <!--  <span class="stock-status out-stock"> Sale Off </span> -->
                                <h3 class="title-detail"><a id="product_name" href="#" class="text-heading"></a></h3>
                                <!--  <div class="product-detail-rating">
                                     <div class="product-rate-cover text-end">
                                         <div class="product-rate d-inline-block">
                                             <div class="product-rating" style="width: 90%"></div>
                                         </div>
                                         <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                     </div>
                                 </div> -->
                                <div class="clearfix product-price-cover" style="line-height: 0.75rem;">
                                    <div class="product-price primary-color float-left d-flex">
                                        <span class="current-price mb-2 d-flex text-brand font-weight-bold text-themecolor">৳ <span id="pprice"></span></span>
                                        <span>
                                      <!--   <span class="save-price font-md color3 ml-15">26% Off</span> -->
                                        <del id="oldprice" class="old-price font-md ml-2 mb-2" style="color: grey">৳</del>
                                    </span>
                                    </div>
                                </div>
                                <form id="choice_form" class="mt-3">
                                    <div class="row " id="attributes">
                                        <div class="form-group col-lg-6" id="colorArea">
                                            {{-- <label style=" font-weight:bold;color: black;">Chose Color <span>**</span></label>
                                            <select class="form-control" id="color" name="color">
                                                <option value="">--Choose Color--</option>
                                            </select> --}}
                                        </div>
                                    </div>

                                    <div class="row" id="attribute_alert">

                                    </div>
                                </form>
                                <div class="font-xs">
                                    <div style="list-style: none">
                                        <p class="mb-1">{{session()->get('language') == 'bangla' ? 'ক্যাটাগোরি':'Category'}}:
                                            <span class="text-brand" id="pcategory">

                                        </span>
                                        </p>
                                        <p class="mb-1">{{session()->get('language') == 'bangla' ? 'ব্র্যান্ড':'Brand'}}:
                                            <span class="text-brand" id="pbrand">

                                        </span>
                                        </p>
                                        <p class="mb-1 d-none">{{session()->get('language') == 'bangla' ? 'পণ্য কোড':'Product Code'}}:
                                            <span class="text-brand" id="pcode">

                                        </span>
                                        </p>
                                        <p class="mb-1">{{session()->get('language') == 'bangla' ? 'স্টক':'Stock'}}:
                                            <span class="badge badge-pill badge-success" id="pavailable" style="background: green; color: white;">
                                                {{session()->get('language') == 'bangla' ? 'স্টকে আছে':'Available'}}
                                            </span>
                                            <span class="badge badge-pill badge-danger" id="pstockout" style="background: red; color: white;">
                                                {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Stock Out'}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="detail-extralink align-items-baseline d-flex" style="margin-top: 30px;">
                                    <div class="mr-10">
                                        <span class="">{{session()->get('language') == 'bangla' ? 'পরিমাণ':'Quantity'}}:</span>
                                    </div>
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" name="quantity" class="qty-val form-control" value="{{ $product->minimum_buy_qty ?? '1' }}" min="1" id="qty" style="width: 100px">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                                <div class="d-block mt-3" id="qty_stock_alert">

                                </div>
                                <div class="detail-extralink d-flex mb-30" style="margin-top: 10px;">
                                    <!-- <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                        <input type="text" name="quantity" class="qty-val" id="qty" value="1" min="1">

                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div> -->
                                    <div class="product-extra-link2">
                                        <input type="hidden" id="product_id">
                                        <input type="hidden" id="pname">
                                        <input type="hidden" id="product_price">
                                        <input type="hidden" id="discount_amount">
                                        <input type="hidden" id="pfrom" value="modal">
                                        <input type="hidden" id="pvarient" value="">

                                        <input type="hidden" id="minimum_buy_qty" value="">
                                        <input type="hidden" id="stock_qty" value="">

                                        <input type="hidden" id="buyNowCheck" value="0">

                                        <button style="width: 100px"  class="like btn btn-outline-dark buy_now" onclick="buyProduct()"><i class="fi-rs-shopping-cart" ></i>
                                            {{session()->get('language') == 'bangla' ? 'এখুনি কিনুন':'Buy Now'}}
                                        </button>

                                        <button style="width: 100px"  class="like btn button btn-outline-dark add_to_cart" onclick="addToCart()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>
                                            {{session()->get('language') == 'bangla' ? 'কার্টে যোগ করুন':'Add to Cart'}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Log In Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog modal-xl login-pop-form" role="document">
            <div class="modal-content" id="loginmodal">
                <div class="modal-headers">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="m-0 ft-regular">Login</h2>
                    </div>

                    <form>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Username*">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password*">
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input id="dd" class="checkbox-custom" name="dd" type="checkbox">
                                    <label for="dd" class="checkbox-custom-label">Remember Me</label>
                                </div>
                                <div class="eltio_k2">
                                    <a href="#">Lost Your Password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>

                        <div class="form-group text-center mb-0">
                            <p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    @include('FrontEnd.include.mobile_search_bar')
    <!-- Wishlist -->
    <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
        <div class="rightMenu-scroll">
            <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
                <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
            </div>
            <div class="right-ch-sideBar">

                <div class="cart_select_items py-2">
                    <!-- Single Item -->
                    <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                        <div class="cart_single d-flex align-items-center">
                            <div class="cart_selected_single_thumb">
                                <a href="#"><img src="{{asset('FrontEnd')}}/assets/img/product/4.jpg" width="60" class="img-fluid" alt="" /></a>
                            </div>
                            <div class="cart_single_caption pl-2">
                                <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Women Striped Shirt Dress</h4>
                                <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span class="text-dark small">Red</span></p>
                                <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                            </div>
                        </div>
                        <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                    </div>

                    <!-- Single Item -->
                    <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                        <div class="cart_single d-flex align-items-center">
                            <div class="cart_selected_single_thumb">
                                <a href="#"><img src="{{asset('FrontEnd')}}/assets/img/product/7.jpg" width="60" class="img-fluid" alt="" /></a>
                            </div>
                            <div class="cart_single_caption pl-2">
                                <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Floral Print Jumpsuit</h4>
                                <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span class="text-dark small">Red</span></p>
                                <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                            </div>
                        </div>
                        <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                    </div>

                    <!-- Single Item -->
                    <div class="d-flex align-items-center justify-content-between px-3 py-3">
                        <div class="cart_single d-flex align-items-center">
                            <div class="cart_selected_single_thumb">
                                <a href="#"><img src="{{asset('FrontEnd')}}/assets/img/product/8.jpg" width="60" class="img-fluid" alt="" /></a>
                            </div>
                            <div class="cart_single_caption pl-2">
                                <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Solid A-Line Dress</h4>
                                <p class="mb-2"><span class="text-dark ft-medium small">30</span>, <span class="text-dark small">Blue</span></p>
                                <h4 class="fs-md ft-medium mb-0 lh-1">$100</h4>
                            </div>
                        </div>
                        <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                    </div>

                </div>

                <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                    <h6 class="mb-0">Subtotal</h6>
                    <h3 class="mb-0 ft-medium">$417</h3>
                </div>

                <div class="cart_action px-3 py-3">
                    <div class="form-group">
                        <button type="button" class="btn d-block full-width btn-dark">Move To Cart</button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn d-block full-width btn-dark-light">Edit or View</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Cart -->
    <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
        <div class="rightMenu-scroll">
            <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
                <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
            </div>
            <div class="right-ch-sideBar">

                @php use Gloudemans\Shoppingcart\Facades\Cart; @endphp
                @php  $subtotal = 0; @endphp
{{--                @php dd(Cart::content()) @endphp--}}
                <div class="cart_select_items py-2">
                    @php $cart_products = get_cart_data() @endphp
                    @if(count($cart_products) > 0)
                        @foreach($cart_products as $cart)
                            <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                <div class="cart_single d-flex align-items-center">
                                    <div class="cart_selected_single_thumb">
                                        @php $product = get_product_by_id($cart->id) @endphp
                                        <a href="#"><img src="{{asset($product->product_thumbnail)}}" width="60" class="img-fluid" alt="" /></a>
                                    </div>
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{$product->name_en}}</h4>
                                        <p class="mb-2"><span class="text-dark ft-medium small">{{$cart->qty}}</span>, <span class="text-dark small">Red</span></p>
                                        <h4 class="fs-md ft-medium mb-0 lh-1">৳{{$cart->price}}</h4>
                                    </div>
                                </div>
                                <div class="fls_last"><button class="close_slide gray" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="ti-close"></i></button></div>
                            </div>
                            @php $subtotal+= $cart->price @endphp
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                            No Item Included
                        </div>

                    @endif
                    <!-- Single Item -->


                </div>

                <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                    <h6 class="mb-0">Subtotal</h6>
                    <h3 class="mb-0 ft-medium">৳{{$subtotal}}</h3>
                </div>

                <div class="cart_action px-3 py-3">
                    <div class="form-group">
                        <button type="button" class="btn d-block full-width btn-dark">Checkout Now</button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn d-block full-width btn-dark-light">Edit or View</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

    <div class="sticky-contact-btn d-block">
        <a href="https://wa.me/+8801714499755"><img src="{{asset('FrontEnd/assets/img')}}/whatsapp_icon.png" style="width: 100%"></a>
    </div>

    <!--Start of Tawk.to Script-->
    {{--<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/67a984043a842732607c53b9/1ijn2nd1a';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>--}}
    <!--End of Tawk.to Script-->


</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
@include('FrontEnd.include.script')
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
@stack('js')
<script>
    function openWishlist() {
        document.getElementById("Wishlist").style.display = "block";
    }
    function closeWishlist() {
        document.getElementById("Wishlist").style.display = "none";
    }
</script>

<script>
    function openCart() {
        document.getElementById("Cart").style.display = "block";
    }
    function closeCart() {
        document.getElementById("Cart").style.display = "none";
    }
</script>

<script>
    function openSearch() {
        document.getElementById("Search").style.display = "block";
    }
    function closeSearch() {
        document.getElementById("Search").style.display = "none";
    }
</script>

<script>
  $(document).ready(function() {
    $('#back2Top').click(function(e) {
      e.preventDefault(); // Prevent the default anchor behavior (which adds #)
      $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
  });
</script>

</body>

</html>
