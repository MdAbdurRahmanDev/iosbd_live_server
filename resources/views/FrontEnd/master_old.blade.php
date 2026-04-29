<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{get_setting('business_name')->value}} | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset(get_setting('site_favicon')->value)}}" type="image/x-icon">
    @include('FrontEnd.include.style')

</head>

<body>
    <!-- Header Part Start -->
    @include('FrontEnd.include.header')
    <!-- Header Part End -->

    <!-- Body Part Start -->
    <main>
        @yield('content')
    </main>
    <!-- Body Part End -->
    <!-- Quick view -->


    <!-- Footer Start -->
    @include('FrontEnd.include.footer')
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top display-tp"><i class="fa fa-arrow-up"></i></a>
    <!-- End Back to Top -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModel"></button>
                <div class="modal-body">
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
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price mb-2 d-flex text-brand">৳ <span id="pprice"></span></span>
                                        <span>
                                      <!--   <span class="save-price font-md color3 ml-15">26% Off</span> -->
                                        <del id="oldprice" class="old-price font-md ml-15 mb-2" style="color: grey">৳</del>
                                    </span>
                                    </div>
                                </div>
                                <form id="choice_form">
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
                                    <ul style="list-style: none">
                                        <li class="mb-1">{{session()->get('language') == 'bangla' ? 'ক্যাটাগোরি':'Category'}}:
                                            <span class="text-brand" id="pcategory">

                                        </span>
                                        </li>
                                        <li class="mb-1">{{session()->get('language') == 'bangla' ? 'ব্র্যান্ড':'Brand'}}:
                                            <span class="text-brand" id="pbrand">

                                        </span>
                                        </li>
                                        <li class="mb-1 d-none">{{session()->get('language') == 'bangla' ? 'পণ্য কোড':'Product Code'}}:
                                            <span class="text-brand" id="pcode">

                                        </span>
                                        </li>
                                        <li class="mb-1">{{session()->get('language') == 'bangla' ? 'স্টক':'Stock'}}:
                                            <span class="badge badge-pill badge-success" id="pavailable" style="background: green; color: white;">
                                                {{session()->get('language') == 'bangla' ? 'স্টকে আছে':'Available'}}
                                            </span>
                                            <span class="badge badge-pill badge-danger" id="pstockout" style="background: red; color: white;">
                                                {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Stock Out'}}
                                            </span>
                                        </li>
                                    </ul>
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

                                        <button  class="like btn button button-add-to-cart add_to_cart" onclick="test()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>
                                            {{session()->get('language') == 'bangla' ? 'কার্টে যোগ করুন':'Add to Cart'}}
                                        </button>

                                        <button  class="like btn button button-add-to-cart ml-5 buy_now" onclick="buyProduct()"><i class="fi-rs-shopping-cart" ></i>
                                            {{session()->get('language') == 'bangla' ? 'এখুনি কিনুন':'Buy Now'}}
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
    @include('FrontEnd.include.script')
    @stack('js')
</body>

</html>
