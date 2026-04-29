@extends('FrontEnd.master')
@section('title')
    All Products
@endsection
@section('content')
    <style>
        @media (min-width: 668px) and (max-width: 1920px) {
            .add_to_cart, .buy_now{
                width: 129px;
            }
        }
        @media (max-width: 667px) {
            .buy_now{
                width: 63px;
            }
            .add_to_cart{
                width: 75px;
            }
        }
    </style>

    @php
        $min_price = 0;
        $max_price = 1000000000;
       if(isset($_GET['min_price']) && $_GET['min_price']>0){
           $min_price = $_GET['min_price'];
       }
       if(isset($_GET['max_price']) && $_GET['max_price']>0){
           $max_price = $_GET['max_price'];
       }
    @endphp
<div class="container-fluid py-2 page-header">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="fw-bold">{{session()->get('language') == 'bangla' ? 'সমস্ত পণ্য':'All Products'}}</h2>
                <!--<h5 class="display-6 fw-semibold">{{session()->get('language') == 'bangla' ? 'ডিল প্রতিদিন আপডেট করা হয়':'Deals updated daily'}}</h5>-->
            </div>
        </div>
    </div>
</div>

<!-- Product Start -->
<section class="just-for-you container pt-0">
{{--    <h2>Sale On Now</h2>--}}
{{--    <hr>--}}
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-3 col-md-12 d-none d-lg-block bg-white p-4">
                <!-- Price Start -->
                <form action="">
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold">{{session()->get('language') == 'bangla' ? 'মূল্য দ্বারা ফিল্টার':'Filter by price'}}</h5>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-group">
{{--                                <label class="form-check-label">Price: </label>--}}
{{--                                <input name="range[]" type="range" min="0" max="100000" class="form-range" id="slider-range" value="0">--}}
{{--                                <input name="range[]" type="range" min="0" max="100000" class="form-range" id="slider-range" value="0">--}}
{{--                                <br>--}}
                                <div>
                                    <div class="form-group">
                                        <label for="lower_limit" class="form-control-label">{{session()->get('language') == 'bangla' ? '':'From'}}</label>
                                        <input type="number" name="min_price" id="lower_limit" value="@isset($_GET['min_price']){{$_GET['min_price']}}@endisset" style="margin-right:5px; width: 80px; font-size: 14px" >
                                        <label for="upper_limit" class="form-control-label">{{session()->get('language') == 'bangla' ? 'থেকে':'To'}}</label>
                                        <input type="number" name="max_price" value="@isset($_GET['max_price']){{$_GET['max_price']}}@endisset" id="upper_limit" style="width: 80px; font-size: 14px" >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Price End -->

                    <div class="border-bottom mb-5">
                        <h5 class="font-weight-semi-bold">{{session()->get('language') == 'bangla' ? 'স্টক উপলব্ধতা দ্বারা ফিল্টার':'Filter By Stock Availability'}}</h5>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" name="stock" value="1" class="form-check-input pl-0 m-0" id="size-all" @isset($_GET['stock']){{$_GET['stock'] >0 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="size-all">{{session()->get('language') == 'bangla' ? 'স্টক আছে':'In Stock'}}</label>
                            <span class="border px-2">{{count(getInstockPorducts())}}</span>
                        </div>
                    </div>

                    <!-- category Start -->
                    <div class=" pb-4">
                        <details>
                            <summary class="mb-2">
                                <span style="font-size: 19px" class="font-weight-semi-bold mb-4 text-dark">{{session()->get('language') == 'bangla' ? 'ক্যাটাগরি দ্বারা ফিল্টার':'Filter by Category'}}</span>
                            </summary>
                            @foreach(get_categories() as $category)
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="form-check-input m-0" name="category[]" value="{{$category->name_en}}"
                                           @isset($_GET['category']){{in_array($category->name_en, $_GET['category']) ? 'checked':''}} @endisset id="color-all">
                                    <label class="form-check-label" for="price-all">{{session()->get('language') == 'bangla'? $category->name_bn:$category->name_en}}</label>
                                    <span class="border px-2">{{count(get_category_products($category->slug))}}</span>
                                </div>
                            @endforeach
                        </details>

                    </div>
                    <!-- category End -->

                    <!-- category Start -->
                    <div class="border-bottom pb-4">
                        <details>
                            <summary class="mb-2">
                                <span style="font-size: 19px" class=" text-dark font-weight-semi-bold mb-4">{{session()->get('language') == 'bangla' ? 'ব্র্যান্ড দ্বারা ফিল্টার':'Filter by Brands'}}</span>
                            </summary>

                            @foreach(get_brands() as $brand)
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="form-check-input m-0" name="brand[]" value="{{$brand->name_en}}"
                                           @isset($_GET['brand']){{in_array($brand->name_en, $_GET['brand']) ? 'checked':''}} @endisset id="color-all">
                                    <label class="form-check-label" for="price-all">{{session()->get('language') == 'bangla' ? $brand->name_bn:$brand->name_en}}</label>
                                    <span class="border px-2">{{count(get_brand_products($brand->id))}}</span>
                                </div>
                            @endforeach
                        </details>
                    </div>
                    <!-- category End -->


                    <div class="mb-5 m-auto">
                        <button type="submit" class="form-control btn btn-primary">{{session()->get('language') == 'bangla' ? 'ফিল্টার': 'Filter'}}</button>
                    </div>
                </form>

            </div>
            <div class="col-lg-9 col-md-12">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                    @if(count($products)>0)
                        @foreach($products as $product)
                            @php $data = calculateDiscount($product->id) @endphp

                            @php
                                $aggregates = $product->product_review_aggregates->first();
                                $review_count = 0;
                                $review_sum = 0;
                                $avaRanting = 0;
                                $avaRantingPar = 0;
                                if($aggregates){
                                    $review_count = $aggregates->review_count;
                                    $review_sum = $aggregates->total_rating;
                                    $avaRanting = $review_sum / $review_count * 1.0;
                                    $avaRantingPar = ($avaRanting * 100) / 5;
                                }
                            @endphp

                            <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                <div class="product_grid card b-0">
                                    {{--                            <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>--}}
                                    @if($product->discount_price != 0)
                                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">{{$data['text']}}</div>
                                    @endif

                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="{{route('product.details', $product->slug)}}"><img class="card-img-top" src="{{asset($product->product_thumbnail)}}" alt="..."></a>
                                            <div class="product-left-hover-overlay">
                                                <ul class="left-over-buttons">
                                                    <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center"><i class="fas fa-expand-arrows-alt position-absolute"></i></a></li>
                                                    <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i class="far fa-heart position-absolute"></i></a></li>
                                                    <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i class="fas fa-shopping-basket position-absolute"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                        <div class="text-left">
                                            <div class="text-left mb-1">
                                                <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                    <div class="back-stars">
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <div class="front-stars" style="width:{{ $avaRantingPar }}%">
                                                            <i  class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i  class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i  class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i  class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i  class="fa fa-star down-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <span class="small">({{ $review_count>1 ? $review_count.' Reviews' : $review_count.' Review' }})</span>
                                                </div>
                                                <h5 class="product_name fs-md mb-0 lh-1 mb-1"><a href="{{route('product.details', $product->slug)}}">{{Str::limit($product->name_en, 38, '...')}}</a></h5>
                                                <div class="elis_rty">
                                                    @if($product->discount_price != 0)
                                                        <del>৳{{$product->regular_price}}</del>
                                                        <span class="ft-bold text-dark fs-sm">৳{{$data['discount']}}</span>
                                                    @else
                                                        <span class="ft-bold text-dark fs-sm">৳{{$product->regular_price}}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="text-center mb-1 p-0">
                                                @if($product->stock_qty == 0)
                                                    <div class="bg-danger text-white out_of_stock">Out of Stock</div>
                                                @elseif($product->is_varient == 1)
                                                    <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if(session()->get('language') == 'bangla')font-size: x-small; @endif"
                                                            class="buy_now btn btn-outline-dark">
                                                        @if(session()->get('language') == 'bangla')
                                                            এখুনি কিনুন
                                                        @else
                                                            Buy Now
                                                        @endif
                                                    </button>
                                                    <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if(session()->get('language') == 'bangla')font-size:x-small @endif"
                                                            class="add_to_cart btn btn-outline-dark">

                                                        @if(session()->get('language') == 'bangla')
                                                            কার্টে যোগ করুন
                                                        @else
                                                            Add to Cart
                                                        @endif
                                                    </button>
                                                @else
                                                    <input type="hidden" id="pfrom" value="direct">
                                                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                                                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                                                    <button type="submit" onclick="buyNow({{ $product->id }})" class="buy_now btn btn-outline-dark ">Buy Now</button>
                                                    <button type="submit" onclick="addToCartDirect({{ $product->id }})" class="add_to_cart btn btn-outline-dark ">Add to Cart</button>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
{{--<div class="text-center my-5">--}}
{{--    --}}{{-- <button type="button" class="view_more">View More</button> --}}
{{--</div>--}}
@endsection
@push('js')
    <script>
        function addToCart() {
            var total_attributes = parseInt($('#total_attributes').val());
            //alert(total_attributes);
            var checkNotSelected = 0;
            var checkAlertHtml = '';
            for (var i = 1; i <= total_attributes; i++) {
                var checkSelected = parseInt($('#attribute_check_' + i).val());
                if (checkSelected == 0) {
                    checkNotSelected = 1;
                    checkAlertHtml += `<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Select ` + $('#attribute_name_' + i).val() + `</span>
												</div>
											</div>
										</div>`;
                }
            }
            if (checkNotSelected == 1) {
                $('#qty_alert').html('');
                //$('#attribute_alert').html(checkAlertHtml);
                $('#attribute_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Select all attributes</span>
												</div>
											</div>
										</div>`);
                return false;
            }
            $('.size-filter li').removeClass("active");
            var product_name = $('#pname').val();
            var id = $('#product_id').val();
            var price = $('#product_price').val();
            var color = $('#color option:selected').val();
            var size = $('#size option:selected').val();
            var quantity = $('#qty').val();
            var varient = $('#pvarient').val();

            var min_qty = parseInt($('#minimum_buy_qty').val());
            if (quantity < min_qty) {
                $('#attribute_alert').html('');
                $('#qty_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Minimum quantity ` + min_qty + ` required.</span>
												</div>
											</div>
										</div>`);
                return false;
            }
            // console.log(min_qty);
            var p_qty = parseInt($('#stock_qty').val());
            // if(quantity > p_qty){
            //     $('#stock_alert').html(`<div class="attr-detail mb-5">
            // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
            // 									<div>
            // 										<i class="fa fa-warning mr-10"></i> <span> Not enough stock.</span>
            // 									</div>
            // 								</div>
            // 							</div>`);
            //     return false;
            // }


            // alert(varient);

            var options = $('#choice_form').serializeArray();
            var jsonString = JSON.stringify(options);
            //console.log(options);

            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            });

            $.ajax({
                type: 'POST',
                url: '/cart/data/store/' + id,
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name,
                    product_price: price,
                    product_varient: varient,
                    options: jsonString,
                },
                success: function (data) {
                    // console.log(data);
                    miniCart();
                    $('#closeModel').click();

                    // Start Sweertaleart Message
                    if ($.isEmptyObject(data.error)) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })

                        $('#qty').val(min_qty);
                        $('#pvarient').val('');

                        for (var i = 1; i <= total_attributes; i++) {
                            $('#attribute_check_' + i).val(0);
                        }

                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })

                        $('#qty').val(min_qty);
                        $('#pvarient').val('');

                        for (var i = 1; i <= total_attributes; i++) {
                            $('#attribute_check_' + i).val(0);
                        }
                    }
                    // Start Sweertaleart Message
                    var buyNowCheck = $('#buyNowCheck').val();
                    //alert(buyNowCheck);
                    if (buyNowCheck && buyNowCheck == 1) {
                        $('#buyNowCheck').val(0);
                        window.location = '/checkout';
                    }

                }
            });
        }


        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function (data) {

                    miniCart();
                    cart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }

    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--           var $rangeInput = $('#slider-range');--}}
{{--           var $lower_limit = $('#lower_limit');--}}
{{--           var $upper_limit = $('#upper_limit');--}}

{{--           $lower_limit.val($rangeInput.attr('min'));--}}
{{--           $upper_limit.val($rangeInput.attr('max'));--}}

{{--           $('#slider-range').on('input', function () {--}}
{{--               $lower_limit.val($rangeInput.val());--}}
{{--           });--}}

{{--           $upper_limit.on('input', function () {--}}
{{--               var $upperLimit = parseInt($upper_limit.val());--}}
{{--               var max_range = parseInt($rangeInput.attr('max'));--}}
{{--               if($upperLimit <= max_range){--}}
{{--                   $rangeInput.val($upperLimit);--}}
{{--               }--}}
{{--               else{--}}
{{--                   $rangeInput.val(max_range);--}}
{{--                   $upper_limit.val(max_range);--}}
{{--               }--}}
{{--           });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
