@extends('FrontEnd.master')
@section('title')
    {{$category->name_en}} Based Products
@endsection
@section('content')
    <div class="container-fluid py-2 page-header">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="fw-bold">{{$category->name_en}}</h2>
                    <!--<h5 class="display-6 fw-semibold">{{ count($products)>0 ? count($products) : 'No' }} {{session()->get('language') == 'bangla' ? 'টি প্রোডাক্ট পাওয়া গেছে':'Product(s) found'}}</h5>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Flash Sale Start -->
    {{-- <section class="flash-sale container-fluid bg-white mt-2">
        <div class="container p-2">
            <div class="d-flex align-items-center">
                <h5 class="me-5 d-none d-md-block">On Sale Now</h5>
                <h5 class="trimmers me-4">Ending in <span>03</span> : <span>47</span> : <span> 45</span></h5>
                <span class="d-none d-md-block">|</span>
                <p class="ms-5 d-none d-md-block">00 : 00 Tomorrow</p>
            </div>
        </div>

    </section> --}}
    <!-- Flash Sale End -->

    <!-- Shop Option Part Start -->
    {{-- <section class="shop-option container-fluid mt-3 p-2">
        <div class="container">
            <ul>
                <li><a href="">All</a></li>
                <li><a href="">Electronic</a></li>
                <li><a href="#">Health &amp; Beauty</a></li>
                <li><a href="">Fashion</a></li>
                <li><a href="">Home &amp; Living</a></li>
                <li><a href="">Supermarket</a></li>
                <li><a href="">Stationary &amp; Toys</a></li>
                <li><a href="">Sports &amp; Motors</a></li>
            </ul>
        </div>
    </section> --}}
    <!-- Shop Option Part End -->


    <!-- Product Start -->
    <section class="middle bg-color-all">
        <div class="just-for-you container mt-2 pt-0">
            <div class="row">
                <div class="col-lg-3 col-md-12 d-none d-lg-block bg-white p-4">
                    <!-- Price Start -->
                    <form action="">
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold">{{session()->get('language') == 'bangla' ? 'মূল্য দ্বারা ফিল্টার':'Filter by price'}}</h5>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="form-group">
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
                                @foreach(get_categories() as $cat)
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" class="form-check-input m-0" name="category[]" value="{{$cat->name_en}}"
                                               @isset($_GET['category']){{in_array($cat->name_en, $_GET['category']) ? 'checked':''}} @endisset id="color-all">
                                        <label class="form-check-label" for="price-all">{{session()->get('language') == 'bangla'? $cat->name_bn:$cat->name_en}}</label>
                                        <span class="border px-2">{{count(get_category_products($cat->slug))}}</span>
                                    </div>
                                @endforeach
                            </details>
                        </div>
                        <!-- category End -->
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
                        <div class="mb-5 m-auto">
                            <button type="submit" class="form-control btn btn-primary">{{session()->get('language') == 'bangla' ? 'ফিল্টার': 'Filter'}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div id="product-container" class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2">
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

                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    <div class="product_grid card b-0">
                                        @if($product->discount_price != 0)
                                            <div class="badge text-white position-absolute ft-regular ab-right text-upper" style="background: #800080;">
                                                Save: {{ str_replace('Off', '', $data['text']) }}
                                            </div>
                                        @endif
                                        <div class="card-body p-0">
                                            <div class="shop_thumb position-relative">
                                                <a class="card-img-top d-block overflow-hidden" href="{{route('product.details', $product->slug)}}">
                                                    <img class="card-img-top bg-white" src="{{asset($product->product_thumbnail)}}" alt="{{ $product->name_en }}">
                                                </a>
                                                <div class="product-left-hover-overlay">
                                                    <ul class="left-over-buttons">
                                                        <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center"><i class="fas fa-expand-arrows-alt position-absolute"></i></a></li>
                                                        <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i class="far fa-heart position-absolute"></i></a></li>
                                                        <li class="d-none"><a href="javascript:void(0);" class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i class="fas fa-shopping-basket position-absolute"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between" style="background: #e6f0ff; border-top: 1px solid #d0e2ff;">
                                            <div class="text-left w-100">
                                                <div class="text-left mb-1" style="padding: 8px 10px;">
                                                    <h5 class="product_name fs-md mb-1 lh-1" style="margin: 0;">
                                                        <a href="{{ route('product.details', $product->slug) }}">
                                                            {{ Str::limit($product->name_en, 38, '...') }}
                                                        </a>
                                                    </h5>
                
                                                    {{-- ✅ Updated Price Section --}}
                                                    @if ($product->discount_price != 0)
                                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                                            <span class="fw-bold fs-lg" style="font-weight: 500; color: #0f188d">৳{{ $data['discount'] }}</span>
                                                            <del class="text-muted fs-sm mb-0">৳{{ $product->regular_price }}</del>
                                                        </div>
                                                    @else
                                                        <span class="fw-bold fs-lg mt-1" style="font-weight: 500; color: #0f188d">৳{{ $product->regular_price }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center mb-1 p-0">
                                                    @if($product->stock_qty == 0)
                                                        <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                                    @elseif($product->is_varient == 1)
                                                        {{-- Varient product buttons hidden --}}
                                                    @else
                                                        <input type="hidden" id="pfrom" value="direct">
                                                        <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                                                        <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                                        <!--<button type="submit" onclick="buyNow({{ $product->id }})" class="buy_now btn btn-outline-dark">Buy Now</button>-->
                                                        <!--<button type="submit" onclick="addToCartDirect({{ $product->id }})" class="add_to_cart btn btn-outline-dark">Add to Cart</button>-->
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
    <div class="text-center my-5">
        {{-- <button type="button" class="view_more">View More</button> --}}
    </div>
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

@endpush
@push('css')
<style>
    .bg-color-all {
        background: #f2f4f8 !important;
    }
</style>
@endpush
