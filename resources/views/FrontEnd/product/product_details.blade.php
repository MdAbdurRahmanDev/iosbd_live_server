@extends('FrontEnd.master')
@section('title')
    {{ $product->name_en }} Details
@endsection
@push('css')
    <style>
        .app-figure {
            width: 100% !important;
            margin: 0px auto;
            border: 0px solid red;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .MagicZoom {
            display: none;
        }

        .MagicZoom.Active {
            display: block;
        }

        .selectors {
            margin-top: 10px;
        }

        .selectors .mz-thumb img {
            max-width: 56px;
        }

        @media screen and (max-width: 1023px) {
            .app-figure {
                width: 99% !important;
                margin: 20px auto;
                padding: 0;
            }
        }

        .share {
            padding-top: 14px;
            padding-right: 20px;
        }
        
        .product-title {
            font-size: 25px;
            line-height: 30px;
        }
    </style>
    <style>
        .rating-group {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }

        .top-0 {
            top: 0;
        }

        .start-0 {
            left: 0;
        }

        .end-0 {
            right: 0;
        }

        .rating-star i {
            font-size: 1rem;
        }

        .rating-star {
            padding: 0;
            font-size: 1rem;
        }

        .rating-input {
            width: 0.8rem;
            height: 0.8rem;
            margin-top: 0;
        }

        .rating-container label {
            width: 1.2rem;
            height: 1.2rem;
        }

        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            color: #ddd;

            font-size: 8px;
            margin-left: -15px;
        }

        .rating input {
            display: none;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked+label,
        .rating input:checked+label~label {
            color: #ffc107;
            font-size: 8px;
        }


        .front-stars,
        .back-stars,
        .star-rating {
            display: flex;
        }

        .star-rating {
            align-items: left;
            font-size: 1.5em;
            justify-content: left;
            margin-left: -5px;
        }


        .back-stars {
            color: #CCC;
            position: relative;
        }

        .front-stars {
            color: #FFBC0B;
            overflow: hidden;
            position: absolute;
            top: 0;
            transition: all 0.5s;
        }


        .percent {
            color: #bb5252;
            font-size: 1.5em;
        }

        .fa-star:before {
            color: #ff9800;
            font-size: 13px;
        }

        .star-rating i {
            font-size: 12px;
        }

        .up-star::before {
            color: #CCC
        }

        .down-star::after {
            color: #ff9800;
        }

        .fa-1x {
            width: 20px;
        }

        @media (max-width: 992px) {

            .rating-star i,
            .rating-star {
                font-size: 1rem;/
            }

            .rating-container label {
                width: 1.1rem;
                height: 1.1rem;
            }

            .star-rating {
                font-size: 1.3em;
                margin-left: 0;
            }

            .percent {
                font-size: 1.3em;
            }

            .fa-star:before {
                font-size: 12px;
            }

            .star-rating i {
                font-size: 12px;
            }

            .fa-1x {
                width: 18px;
            }

            .overall-rating {
                padding-left: 20px;
            }

            .rating-group {
                padding-left: 20px;
            }
        }

        @media (max-width: 576px) {

            .rating-star i,
            .rating-star {
                font-size: 0.8rem;
            }

            .overall-rating {
                padding-left: 20px;
            }

            .rating-group {
                padding-left: 20px;
            }

            .rating-container label {
                width: 1rem;
                height: 1rem;
            }

            .star-rating {
                font-size: 1.2em;
                margin-left: 0;
            }

            .percent {
                font-size: 1.1em;
            }

            .fa-star:before {
                font-size: 10px;
            }

            .star-rating i {
                font-size: 10px;
            }

            .fa-1x {
                width: 15px;
            }
            
            .product-title {
                font-size: 20px;
                line-height: 25px;
            }
        }

        .product-nav li:hover, .product-nav li a:hover {
            color: #fff !important;
        }
    </style>
    <style>
        .social_media_share_container a {
            display: flex;
            align-items: center;
            /* Vertical Center */
            justify-content: center;
            /* Horizontal Center */
            height: 40px;
            /* Button Height */
            width: 40px;
            /* Button Width */
            font-size: 16px;
            /* Icon Size */
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/magiczoomplus/magiczoomplus.css') }}" />
@endpush
@section('content')
    {{--    @php dd($product->product_type) @endphp --}}
    <!-- Product Information Start -->
    <section class="container bg-white p-5">
        <div class="row">
            <?php
            $discount = calculateDiscount($product->id);
            ?>

            <div class="col-md-4">
                <!-- default start -->
                <section id="default" class="pt-0">
                    <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

                    <input type="hidden" id="pname" value="{{ $product->name_en }}">

                    <input type="hidden" id="product_price" value="{{ $discount['discount'] }}">

                    <input type="hidden" id="minimum_buy_qty" value="{{ $product->minimum_buy_qty }}">
                    <input type="hidden" id="stock_qty" value="{{ $product->stock_qty }}">

                    <input type="hidden" id="pvarient" value="">

                    <input type="hidden" id="buyNowCheck" value="0">
                    <input type="hidden" name="" id="discount_amount"
                        value="{{ $product->regular_price - $discount['discount'] }}">
                    <div class="">
                        <div class="">
                            <div class="xzoom-container product_details_img_container">
                                <img class="xzoom" id="xzoom-default" src="{{ asset($product->product_thumbnail) }}"
                                    xoriginal="{{ asset($product->product_thumbnail) }}" width="300px" />
                                <div class="xzoom-thumbs m-auto" style="margin-top: 5px !important;">
                                    <a href="{{ asset($product->product_thumbnail) }}"><img class="xzoom-gallery"
                                            width="40" src="{{ asset($product->product_thumbnail) }}"
                                            xpreview="{{ asset($product->product_thumbnail) }}"></a>
                                    @foreach ($multiImg as $image)
                                        <a href="{{ asset($image->photo_name) }}"><img class="xzoom-gallery" width="40"
                                                src="{{ asset($image->photo_name) }}"></a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- default end -->
            </div>

            <div class="col-md-5">
                <div class="{{ $discount['discount'] == $product->regular_price ? 'd-none' : '' }}"
                    style="background-color: rgba(247,147,41,0.3); border-radius: 5px; color: rgb(247,147,41); width: 70px;">
                    <p class="m-1 text-center">{{ $discount['text'] }}</p>
                </div>
                {{--                <span class="stock-status out-stock"> ৳{{  $discount }} Off </span> --}}
                <h1 class="product-title">
                    @if (session()->get('language') == 'bangla')
                        {{ $product->name_bn }}
                    @else
                        {{ $product->name_en }}
                    @endif
                </h1>

                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="star-rating mt-2 me-3 pl-2" title="">
                            <div class="back-stars">
                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                <i class="fa fa-star up-star" aria-hidden="true"></i>

                                <div class="front-stars" style="width:{{ $avaRantingPar_p }}%">
                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 pl-3" style="color:black">
                            ({{ $product->product_reviews_count > 1 ? $product->product_reviews_count . ' Reviews' : $product->product_reviews_count . ' Review' }})
                        </div>
                    </div>

                    <div class="ms-auto d-flex justify-content-end share position-relative">
                        <a href="javascript:void(0);" class="text-dark" title="Share Product" id="shareBtn">
                            <i class="fa fa-share-alt fa-lg"></i>
                        </a>

                        <!-- Dropdown Container -->
                        <div class="social_media_share_container position-absolute bg-white p-2 shadow rounded d-none"
                            id="shareDropdown" style="top: 30px; right: 0;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" class="d-block text-white text-center p-2 rounded mb-1"
                                style="background: #006cff;">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                target="_blank" class="d-block text-white text-center p-2 rounded mb-1"
                                style="background: #333;">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"
                                target="_blank" class="d-block text-white text-center p-2 rounded mb-1"
                                style="background: #03a84e;">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                target="_blank" class="d-block text-white text-center p-2 rounded"
                                style="background: #1a94a9;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>

                    </div>
                </div>

                <div>

                    <h4 class="price">
                        @if (session()->get('language') == 'bangla')
                            বর্তমান মূল্য:
                        @else
                            Current Price:
                        @endif
                        <span class="product_price current-price">৳{{ $discount['discount'] }}</span>
                        @if ($discount['discount'] != $product->regular_price)
                            <del class="old-price {{ $discount['discount'] == 0 ? 'd-none' : '' }}" style="color: grey">
                                ৳{{ $product->regular_price }}</del>
                        @endif


                    </h4>
                    <p class="">
                    <p>
                        @if (session()->get('language') == 'bangla')
                            <span class="text-dark">ক্যাটাগোরি:</span> {{ $product->category->name_bn ?? '' }}
                        @else
                            <span class="text-dark">Product Category:</span> {{ $product->category->name_en ?? '' }}
                        @endif

                    </p>
                    @if ($product->product_type == 2 && count($group_products) > 0)
                        <strong>
                            @if (session()->get('language') == 'bangla')
                                <span class="text-dark">প্যাকেজের পণ্য সমূহ:</span>
                            @else
                                <span class="text-dark">Package Items:</span>
                            @endif
                            :
                        </strong>
                        @foreach ($group_products as $item)
                            <div class="row mb-1">
                                <div class="col-md-1">
                                    <a href="{{ route('product.details', $item->product->slug) }}">
                                        <img src="{{ asset($item->product->product_thumbnail) }}" alt=""
                                            height="30px" width="30px">
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <a href="{{ route('product.details', $item->product->slug) }}">
                                        <p>
                                            @if (session()->get('language') == 'bangla')
                                                {{ $item->product->name_bn }}
                                            @else
                                                {{ $item->product->name_en }}
                                            @endif
                                        </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>
                            @if (session()->get('language') == 'bangla')
                                <span class="text-dark">ব্র্যান্ড:</span> {{ $product->brand->name_bn ?? '' }}
                            @else
                                <span class="text-dark">Brand:</span>
                                {{ $product->brand->name_en ?? 'N/A' }}
                            @endif


                        </p>
                    @endif
                    <p>
                        @if (session()->get('language') == 'bangla')
                            <span class="text-dark">স্টক:</span>
                        @else
                            <span class="text-dark">Stock:</span>
                        @endif
                        <span class="{{ $product->stock_qty > 0 ? 'text-success' : 'text-danger' }}">
                            @if (session()->get('language') == 'bangla')
                                {{ $product->stock_qty > 0 ? 'স্টকে আছে' : 'স্টক আউট' }}
                            @else
                                {{ $product->stock_qty > 0 ? 'In Stock' : 'Out of Stock' }}
                            @endif

                        </span>
                        <span id="stock_qty"
                            class="d-none">{{ $product->stock_qty != 0 ? '(' . $product->stock_qty . ')' : '' }}</span>
                    </p><br>

                    <div class="d-none"
                        style="background-color: rgba(247,147,41,0.1); border-radius: 30px; padding: 10px; margin: 10px 0; color: #ff00c3; width: 50%">
                        <p style="color: #f9A11E; margin: 0 15%">
                            <i class="fa fa-star" style="margin-right: 5px"></i>
                            {{ $product->points }}
                            @if (session()->get('language') == 'bangla')
                                স্টার পয়েন্ট
                            @else
                                Start Points
                            @endif

                        </p>
                    </div>
                    </p>
                </div>
                <form id="choice_form">
                    <div class="row " id="choice_attributes">
                        @if ($product->is_varient)
                            {{--                            @php dd($product->attribute_values->attribute_id)  @endphp --}}
                            @php $i=0; @endphp
                            @foreach (json_decode($product->attribute_values) as $attribute)
                                @php
                                    $attr = get_attribute_by_id($attribute->attribute_id);
                                    $i++;
                                    //                                    dd($attribute->attribute_id, $attr->name, $attribute->values[0], $product->id, 1)
                                @endphp
                                <input type="hidden" name=""
                                    onload="selectAttribute('{{ $attribute->attribute_id }}', '{{ $attr->name }}', '{{ $attribute->values[0] }}', '{{ $product->id }}', '1')">
                                <div class="attr-detail attr-size mb-3 col-12">
                                    <strong class="mr-10">{{ $attr->name }}: </strong>
                                    <input type="hidden" name="attribute_ids[]" id="attribute_id_{{ $i }}"
                                        value="{{ $attribute->attribute_id }}">
                                    <input type="hidden" name="attribute_names[]"
                                        id="attribute_name_{{ $i }}" value="{{ $attr->name }}">
                                    <input type="hidden" id="attribute_check_{{ $i }}" value="0">
                                    <input type="hidden" id="attribute_check_attr_{{ $i }}" value="0">
                                    <div class="list-filter size-filter font-p">
                                        @foreach ($attribute->values as $key => $value)
                                            <label class="radio-inline">
                                                <input type="radio" class="m-2"
                                                    onclick="selectAttribute('{{ $attribute->attribute_id }}{{ $attr->name }}', '{{ $value }}', '{{ $product->id }}', '{{ $i }}')"
                                                    name="option_{{ $i }}">{{ $value }}
                                            </label>
                                            @php $key++; @endphp
                                        @endforeach
                                        <input type="hidden" name="attribute_options[]"
                                            id="{{ $attribute->attribute_id }}{{ $attr->name }}"
                                            class="attr_value_{{ $i }}">
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" id="total_attributes"
                                value="{{ count(json_decode($product->attribute_values)) }}">
                        @endif
                    </div>
                </form>

                <div class="row" id="attribute_alert">

                </div>
                @if ($product->stock_qty > 0)
                    <div id="p_in_stock">
                        <div class="detail-extralink mb-3 align-items-baseline d-flex" id="">
                            <div class="mr-10">
                                <span class="">
                                    @if (session()->get('language') == 'bangla')
                                        পরিমাণ:
                                    @else
                                        Quantity:
                                    @endif

                                </span>
                            </div>
                            <div class="detail-qty border radius mx-2 px-1">
                                <a href="#" class="qty-down"><i class="fa fa-minus text-dark"></i></a>
                                <input type="text" name="quantity" class="qty-val"
                                    value="{{ $product->minimum_buy_qty }}" min="{{ $product->minimum_buy_qty }}"
                                    id="qty" style="border: none; width: 30px; height: 50px; text-align: center"
                                    readonly>
                                <a href="#" class="qty-up"><i class="fa fa-plus text-dark"></i></a>
                            </div>
                            <div class="row mb-3" id="qty_stock_alert">

                            </div>

                        </div>

                        <div class="d-flex">
                            <input type="hidden" id="pfrom" value="direct">
                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                value="{{ $product->name_en }}">
                            <button class="like btn btn btn-outline-dark"
                                id="{{ $product->is_varient == 1 ? '' : 'buy_now' }}" type="button"
                                onclick="{{ $product->is_varient == 1 ? 'buyProduct()' : '' }}" style="font-size: 15px; ">
                                @if (session()->get('language') == 'bangla')
                                    এখুনি কিনুন
                                @else
                                    Buy Now
                                @endif
                            </button>
                            {{--                    <button class="like btn" style="margin-left: 5px" type="button" onclick="addToCartDirect({{$product->id}})">Add to cart</button> --}}
                            <button class="like btn btn btn-outline-dark" style="margin-left: 5px; font-size: 15px; "
                                type="button" onclick="test()">
                                @if (session()->get('language') == 'bangla')
                                    কার্টে যোগ করুন
                                @else
                                    Add to Cart
                                @endif
                            </button>
                        </div>
                    </div>
                @endif

                <div class="bg-danger text-white text-center out_of_stock @if ($product->stock_qty > 0) d-none @endif"
                    id="p_out_of_stock">Out of Stock</div>

            </div>
            <div class="col-md-3 mt-5 mt-md-0">
                <div>
                    <div class="d-flex justify-content-between">
                        <p><i class="fa-solid fa-truck-fast"></i>
                            @if (session()->get('language') == 'bangla')
                                স্ট্যান্ডার্ড ডেলিভারি
                            @else
                                Standard Delivery
                            @endif
                        </p>
                        <p>৳{{ get_setting('standard_delivery_charge')->value }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><i class="fa-solid fa-clock"></i>
                            @if (session()->get('language') == 'bangla')
                                স্ট্যান্ডার্ড সময়
                            @else
                                Standard Duration
                            @endif
                        </p>
                        <p>{{ get_setting('standard_delivery_time')->value }}</p>
                    </div>
                    @if (get_setting('is_cod_available')->value == 1)
                        <p>
                            <i class="fa-regular fa-handshake"></i>
                            @if (session()->get('language') == 'bangla')
                                ক্যাশ অন ডেলিভারি পাওয়া যাচ্ছে
                            @else
                                Cash on Delivery Available
                            @endif
                        </p>
                    @endif
                </div>
                <hr class="d-none">
                <div class="d-none">
                    {{--                    <p>ডেলিভারি</p> --}}
                    {{--                    <p><i class="fa-solid fa-person-walking-arrow-loop-left"></i> 7 Days Returns</p> --}}
                    @if ($product->is_replaceable == 1)
                        <p>{{ session()->get('language') == 'bangla' ? 'পণ্য প্রতিস্থাপন' . get_setting('order_return_duration')->value . 'দিনের আগে প্রযোজ্য' : 'Replacement Applicable Before ' . get_setting('order_return_duration')->value . ' Days' }}
                        </p>
                    @else
                        <p>{{ session()->get('language') == 'bangla' ? 'পণ্য প্রতিস্থাপন প্রযোজ্য নয়' : 'Product Replacement Not Applicable' }}
                        </p>
                    @endif

                    <p><i
                            class="fa-solid fa-gears"></i>{{ session()->get('language') == 'bangla' ? 'ওয়ারেন্টি পাওয়া যাবে না' : ' Warranty Not Available' }}
                    </p>
                </div>
                <!--<hr>-->
                <div class="d-none">
                    <p>
                        @if (session()->get('language') == 'bangla')
                            বিক্রেতা
                        @else
                            Sold By
                        @endif

                    </p>
                    <div class="d-flex justify-content-between">
                        <p><i class="fa-solid fa-shop"></i>
                            {{ $product->vendor_id != 0 ? $product->vendor->shop_name : get_setting('business_name')->value }}
                        </p>
                        {{--                        <a href="#"><i class="fa-regular fa-message"></i> CHAT</a> --}}
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product Information End -->
    {{-- old description code  --}}
    <!-- Description Part Start -->
    {{-- <section class="container pt-0">
        <div class="row g-3">
            <div class="col-md-8 bg-white">
                <div class="p-4">
                    <div>
                        <h4>
                            @if (session()->get('language') == 'bangla')
                                পণ্যের বিবরণ
                            @else
                                About this item
                            @endif

                        </h4>
                        <hr>
                        <h6 class="mb-2">Product details</h6>
                        @if (session()->get('language') == 'bangla')
                            {!! $product->description_bn !!}
                        @else
                            {!! $product->description_en !!}
                        @endif

                    </div>
                </div>
            </div>
            <div class="just-for-you related_products_container col-md-4 bg-white border-start">
                <div class="py-4">
                    <h5 class="my-2">
                        @if (session()->get('language') == 'bangla')
                            সংশ্লিষ্ট পণ্য
                        @else
                            Related Products
                        @endif
                    </h5>
                    <div class="row g-2">
                        @if (count($relatedProduct) > 0)
                            <style>
                                @media (min-width: 668px) and (max-width: 1920px) {
                                     .buy_now{
                                        width: 76px;
                                        font-size: 14px;
                                    }
                                    .add_to_cart{
                                        width: 89px;
                                        font-size: 14px;
                                    }
                                }
                            </style>
                            @foreach ($relatedProduct->take(4) as $r_product)
                                @php $data = calculateDiscount($r_product->id) @endphp

                                @php
                                    $aggregates = $r_product->product_review_aggregates->first();
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

                                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                    <div class="product_grid card b-0">
                                        @if ($r_product->discount_price != 0)
                                            <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">{{$data['text']}}</div>
                                        @endif

                                        <div class="card-body p-0">
                                            <div class="shop_thumb position-relative">
                                                <a class="card-img-top d-block overflow-hidden" href="{{route('product.details', $r_product->slug)}}"><img class="card-img-top" src="{{asset($r_product->product_thumbnail)}}" alt="..."></a>
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
                                                    <!--<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">-->
                                                    <!--    <div class="back-stars">-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <div class="front-stars" style="width:{{ $avaRantingPar }}%">-->
                                                    <!--            <i  class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i  class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i  class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i  class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i  class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--    <span class="" style="font-size: 16px">({{ $review_count>1 ? $review_count.' Reviews' : $review_count.' Review' }})</span>-->
                                                    <!--</div>-->
                                                    <h5 class="product_name fs-md mb-1 lh-1" style="margin: 0;">
                                                        <a href="{{ route('product.details', $r_product->slug) }}">
                                                            {{ Str::limit($r_product->name_en, 38, '...') }}
                                                        </a>
                                                    </h5>
                
                                                    @if ($r_product->discount_price != 0)
                                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                                            <span class="fw-bold fs-lg" style="font-weight: 500; color: #0f188d">৳{{ $data['discount'] }}</span>
                                                            <del class="text-muted fs-sm mb-0">৳{{ $r_product->regular_price }}</del>
                                                        </div>
                                                    @else
                                                        <span class="fw-bold fs-lg mt-1" style="font-weight: 500; color: #0f188d">৳{{ $r_product->regular_price }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center mb-1 p-0">
                                                    @if ($r_product->stock_qty == 0)
                                                        <div class="bg-danger text-white out_of_stock">Out of Stock</div>
                                                    @elseif($r_product->is_varient == 1)
                                                        <!--<button type="submit" id="{{ $r_product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif"-->
                                                        <!--        class="buy_now btn btn-outline-dark">-->
                                                        <!--    @if (session()->get('language') == 'bangla')-->
                                                        <!--        এখুনি কিনুন-->
                                                        <!--    @else-->
                                                        <!--        Buy Now-->
                                                        <!--    @endif-->
                                                        <!--</button>-->
                                                        <!--<button type="submit" id="{{ $r_product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size:x-small @endif"-->
                                                        <!--        class="add_to_cart btn btn-outline-dark">-->

                                                        <!--    @if (session()->get('language') == 'bangla')-->
                                                        <!--        কার্টে যোগ করুন-->
                                                        <!--    @else-->
                                                        <!--        Add to Cart-->
                                                        <!--    @endif-->
                                                        <!--</button>-->
                                                    @else
                                                        <input type="hidden" id="pfrom" value="direct">
                                                        <input type="hidden" id="product_product_id" value="{{ $r_product->id }}" min="1">
                                                        <input type="hidden" id="{{ $r_product->id }}-product_pname" value="{{ $r_product->name_en }}">

                                                        <!--<button type="submit" onclick="buyNow({{ $r_product->id }})" class="buy_now btn btn-outline-dark ">Buy Now</button>-->
                                                        <!--<button type="submit" onclick="addToCartDirect({{ $r_product->id }})" class="add_to_cart btn btn-outline-dark ">Add to Cart</button>-->
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Products Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Description Part Start -->

    <!-- Description Part Start -->
   <div class="bg-color-all">
     <section class="container pt-0 specification-w">
        <div class="row g-3">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12">
                <div class="p-4 specification-p">
                    <div class="">
                        {{-- <h4>
                            @if (session()->get('language') == 'bangla')
                                পণ্যের বিবরণ
                            @else
                                About this item
                            @endif

                        </h4>
                        <hr> --}}
                        {{-- <h6 class="mb-2">Product details</h6>
                        @if (session()->get('language') == 'bangla')
                            {!! $product->description_bn !!}
                        @else
                            {!! $product->description_en !!}
                        @endif --}}
                            <div class="navs">
                                <ul class="nav product-nav">
                                    <li data-area="specification">Specification</li>
                                    <li data-area="description">Description</li>
                                    <!--<li><a href="#description">Description</a></li>-->
                                    {{-- <li class="hidden-xs" data-area="ask-question">Questions (0)</li> --}}
                                    <li data-area="reviews">Reviews</li>
                                </ul>
                            </div>
                            <section class="specification-tab m-tb-10" id="specification">
                                <div class="section-head">
                                    <h2>Specification</h2>
                                </div>
                                <table class="data-table flex-table table" cellpadding="0" cellspacing="0">
                                    <colgroup>
                                        <col class="name">
                                        <col class="value">
                                    </colgroup>
                                    {{-- <thead class="bg-color-all">
                                        <tr>
                                            <td class="heading-row" colspan="3">Basic Information</td>
                                        </tr>
                                    </thead> --}}
                                    <tbody>

                                        @foreach($productSpecification as $row)
                                            <tr>
                                                <td class="name">{{$row->specification->name}}</td>
                                                <td class="value">{{$row->value}}</td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </section>
                            <div class="description bg-white m-tb-15" id="description">
                                <div class="section-head">
                                    <h2>Description</h2>
                                </div>
                                <div class="full-description" itemprop="description">
                                    @if (session()->get('language') == 'bangla')
                                        {!! $product->description_bn !!}
                                    @else
                                        {!! $product->description_en !!}
                                    @endif
                                    <!--<h2>AMD Ryzen 7 7700 Gaming Desktop PC</h2>-->
                                    <!--<p>The AMD <strong>Ryzen 7 7700 Desktop PC</strong> is a powerful device built for-->
                                    <!--    gaming and demanding applications. This AMD Gaming PC&nbsp;is powered by the-->
                                    <!--    powerful AMD Ryzen 7 7700 Gaming Processor, which boasts 8 cores and 16 threads for-->
                                    <!--    great speed and efficiency. The MSI PRO B650M-P DDR5 AMD AM5 mATX Motherboard-->
                                    <!--    supports the newest DDR5 memory and PCIe 4.0, ensuring future compatibility. This-->
                                    <!--    AMD Desktop&nbsp;PC, housed in the sleek MaxGreen PS195-15 Mid-Tower ATX Gaming-->
                                    <!--    Casing With 4x ARGB Fan, is both elegant and functional. The Team MP44L 500GB M.2-->
                                    <!--    PCIe Gen4 NVMe SSD has rapid read and write speeds, which reduce load times and-->
                                    <!--    improve overall system responsiveness. Multitasking is effortless thanks to the 8GB-->
                                    <!--    of TEAM VULCAN RED DDR5 6000MHz Gaming Desktop RAM. The 1stPlayer FK 300W Power-->
                                    <!--    Supply ensures stable power delivery, making this desktop a reliable choice for-->
                                    <!--    gamers and power users alike</p>-->
                                    <!--<p><strong>For More Details, Please Visit:</strong></p>-->
                                    <!--<p><a href="#" style="">AMD-->
                                    <!--        Ryzen 7 7700 Gaming Processor</a></p>-->
                                    <!--<p><a href="#">MSI PRO B650M-P-->
                                    <!--        DDR5 AMD AM5 mATX Motherboard</a></p>-->
                                    <!--<p><a href="#" target="">MaxGreen PS195-15 Mid-Tower ATX Gaming Casing With 4x ARGB-->
                                    <!--        Fan</a></p>-->
                                    <!--<p><a href="#" target="" style="">Team MP44L 500GB M.2 PCIe Gen4 NVMe SSD</a></p>-->
                                    <!--<p><a href="#" style="">TEAM VULCAN RED 8GB DDR5 6000MHz Gaming Desktop RAM</a></p>-->
                                    <!--<p><a href="#">1stPlayer FK 300W Power Supply</a></p>-->
                                </div>
                            </div>
                            {{-- <div class="latest-price bg-white m-tb-15" id="latest-price">
                                <div class="section-head">
                                    <h2>What is the price of AMD Ryzen 7 7700 Budget Gaming Desktop PC in Bangladesh?</h2>
                                </div>
                                <p>The latest price of AMD Ryzen 7 7700 Budget Gaming Desktop PC in Bangladesh is 50,999৳.
                                    You can buy the AMD Ryzen 7 7700 Budget Gaming Desktop PC at best price from our website
                                    or visit any of our showrooms.</p>
                            </div> --}}
                            {{-- <div class="ask-question q-n-r-section bg-white m-tb-15" id="ask-question">
                                <div class="section-head d-flex question">
                                    <div class="title-n-action">
                                        <h2>Questions (0)</h2>
                                        <p class="section-blurb">Have question about this product? Get specific details
                                            about this product from expert.</p>
                                    </div>
                                    <div class="q-action">
                                        <a href="#"
                                            class="btn st-outline">Ask Question</a>
                                    </div>
                                </div>
                                <div id="question" class="textsms">
                                    <div class="empty-content">
                                        <i class="fa-solid fa-comment "></i>
                                        <div class="empty-text">There are no questions asked yet. Be the first one to ask a
                                            question.</div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                <meta itemprop="ratingValue" content="5">
                                <meta itemprop="reviewCount" content="1">
                            </div> --}}
                            {{-- <div class="review  q-n-r-section bg-white m-tb-15">
                                <div class="section-head review-head">
                                    <div class="title-n-action">
                                        <h2>Reviews (1)</h2>
                                        <p class="section-blurb">Get specific details about this product from customers who
                                            own it.</p>
                                        <div class="average-rating">
                                            <span class="count"><b>5</b><span> out of 5</span></span>
                                            <span class="rating">
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="q-action">
                                        <a href="#"
                                            class="btn st-outline">Write a Review</a>
                                    </div>
                                </div>
                                <div id="review">
                                    <div class="review-wrap">
                                        <div class="review-author">
                                            <span class="rating">
                                                 <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                                <span class="material-icons"><i class="fa-solid fa-star"></i></span>
                                            </span>
                                        </div>
                                        <p class="review review-text">The AMD Ryzen 7 7700 Budget Gaming Desktop PC offers a compelling
                                            mix of performance and affordability, making it a strong choice for gamers and
                                            content creators in Bangladesh.</p>
                                        <p class="author pl-1">By <span class="name">MD Istiake</span> on 08 May 2025</p>
                                    </div>
                                    <div class="text-center"></div>
                                </div>
                            </div> --}}

                            <div class="col-md-12 bg-white pl-3 pb-5 mt-3" id="reviews">
                                <div class="container p-0 p-md-2">
                                    <div class="row">
                                        <div class="col-md-12 mt-5 p-0">
                                            <div class="card-header">
                                                <h2>Ratings & Reviews</h2>
                                            </div>
                                            <div class="overall-rating mb-3 py-5 border-bottom">
                                                <div class="row ">
                                                    <!-- Left Section: Average Rating and Stars -->
                                                    <div class="col-md-6">
                                                        <div>
                                                            <span class="score-avarage me-2"
                                                                style="font-size: 50px; color: black;">{{ $avaRanting_p }}</span>
                                                            <span style="font-size: 40px; color: black;">/</span>
                                                            <span class="score-max me-3" style="font-size: 50px; color: black;">5</span>
                                                        </div>
                                                        <div class="ps-2">
                                                            <div class="d-flex align-items-center pl-3">
                                                                <div class="star-rating mt-2 me-3 pt2" title="">
                                                                    <div class="back-stars">
                                                                        <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                        <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                        <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                        <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                        <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                                                        <div class="front-stars" style="width: {{ $avaRantingPar_p }}%;">
                                                                            <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                            <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                            <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                            <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                            <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pt-2 pl-3" style="color:black">
                                                                ({{ $product->product_reviews_count > 1 ? $product->product_reviews_count . ' Reviews' : $product->product_reviews_count . ' Review' }}
                                                                )
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- Right Section: Smaller Stars -->
                                                    <div class="col-md-6 pt-5 ">
                                                        <div class="star-rating-container"
                                                            style="display: flex; align-items: center; gap: 15px;">
                                                            <div class="star-rating mt-2" title="">
                                                                <div class="back-stars" style="font-size: 14px;">
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: 100; font-size: 14px;">
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="position: relative; width: 150px; height: 12px;">
                                                                <!-- Bottom Bar (Gray) -->
                                                                <div style="width: 100%; height: 12px; background-color: #d4d2c5; position: absolute; top: 0; left: 0;">
                                                                </div>

                                                                @php
                                                                    $five_percentage = 0;
                                                                    if ($product->product_reviews_count > 0 && $five_star > 0) {
                                                                        $five_percentage = ($five_star * 100) / $product->product_reviews_count;
                                                                    }
                                                                @endphp

                                                                <!-- Top Bar (Yellow) -->
                                                                <div style="width: {{ $five_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; z-index: 1;">
                                                                </div>
                                                            </div>




                                                            <span>({{ $five_star }})</span>
                                                        </div>

                                                        <div class="star-rating-container"
                                                            style="display: flex; align-items: center; gap: 15px;">
                                                            <div class="star-rating mt-2" title="">
                                                                <div class="back-stars" style="font-size: 14px;">
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: 80%; font-size: 14px;">
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="position: relative;">
                                                                <div class="bottom-div"
                                                                    style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                                                </div>
                                                                @php
                                                                    $four_percentage = 0;
                                                                    if ($product->product_reviews_count > 0 && $four_star > 0) {
                                                                        $four_percentage =
                                                                            ($four_star * 100) / $product->product_reviews_count;
                                                                    }
                                                                @endphp
                                                                <div class="top-div"
                                                                    style="width: {{ $four_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                                                </div>
                                                            </div>

                                                            <span>({{ $four_star }})</span>
                                                        </div>

                                                        <div class="star-rating-container"
                                                            style="display: flex; align-items: center; gap: 15px;">
                                                            <div class="star-rating mt-2" title="">
                                                                <div class="back-stars" style="font-size: 14px;">
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: 60%; font-size: 14px;">
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="position: relative;">
                                                                <div class="bottom-div"
                                                                    style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                                                </div>
                                                                @php
                                                                    $three_percentage = 0;
                                                                    if ($product->product_reviews_count > 0 && $three_star > 0) {
                                                                        $three_percentage =
                                                                            ($three_star * 100) / $product->product_reviews_count;
                                                                    }
                                                                @endphp
                                                                <div class="top-div"
                                                                    style="width: {{ $three_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                                                </div>
                                                            </div>

                                                            <span>({{ $three_star }})</span>
                                                        </div>

                                                        <div class="star-rating-container"
                                                            style="display: flex; align-items: center; gap: 15px;">
                                                            <div class="star-rating mt-2" title="">
                                                                <div class="back-stars" style="font-size: 14px;">
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: 40%; font-size: 14px;">
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="position: relative;">
                                                                <div class="bottom-div"
                                                                    style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                                                </div>
                                                                @php
                                                                    $two_percentage = 0;
                                                                    if ($product->product_reviews_count > 0 && $two_star > 0) {
                                                                        $two_percentage =
                                                                            ($two_star * 100) / $product->product_reviews_count;
                                                                    }
                                                                @endphp
                                                                <div class="top-div"
                                                                    style="width: {{ $two_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                                                </div>
                                                            </div>

                                                            <span>({{ $two_star }})</span>
                                                        </div>

                                                        <div class="star-rating-container"
                                                            style="display: flex; align-items: center; gap: 15px;">
                                                            <div class="star-rating mt-2" title="">
                                                                <div class="back-stars" style="font-size: 14px;">
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                                    <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: 20%; font-size: 14px;">
                                                                        <i id="star" class="fa fa-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                        <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="position: relative;">
                                                                <div class="bottom-div"
                                                                    style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                                                </div>
                                                                @php
                                                                    $one_percentage = 0;
                                                                    if ($product->product_reviews_count > 0 && $one_star > 0) {
                                                                        $one_percentage =
                                                                            ($one_star * 100) / $product->product_reviews_count;
                                                                    }
                                                                @endphp
                                                                <div class="top-div"
                                                                    style="width: {{ $one_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0px; left: 0; padding: 0px">

                                                                </div>
                                                            </div>

                                                            <span>({{ $one_star }})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            @if ($product->product_reviews->isNotEmpty())
                                                <div class="card-header pb-4 border-bottom">
                                                    <h4>Product Reviews</h4>
                                                </div>
                                            @else
                                                <div class="card-header border-bottom">
                                                    <h4 class="p-0 m-0">No Reviews</h4>
                                                </div>
                                            @endif


                                            @if ($product->product_reviews->isNotEmpty())
                                                @foreach ($product->product_reviews as $key => $review)
                                                    @php

                                                        $ratingPar = ($review->rating * 100) / 5;
                                                    @endphp

                                                    <div class="rating-group mb-4 mt-3 position-relative">
                                                        <!-- Top-right time -->
                                                        <div class="position-absolute top-0 end-0">
                                                            <span class="text-muted"
                                                                style="font-size: 14px;">{{ $review->created_at->format('d M, Y') }}</span>
                                                        </div>
                                                        <!-- User Name -->
                                                        <span style="font-weight: 600">{{ $review->user_name }}</span>
                                                        <!-- Star Rating -->
                                                        <div class="star-rating mt-2" title="">
                                                            <div class="back-stars" style="font-size: 14px;">
                                                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star up-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star up-star" aria-hidden="true"></i>

                                                                <div class="front-stars"
                                                                    style="font-size: 14px; width: {{ $ratingPar }}%; ">
                                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Review Text -->
                                                        <div class="my-3">
                                                            <p>{{ $review->review }}</p>
                                                        </div>

                                                        @foreach ($product->product_reviews as $review)

                                                            <div class="review-item">
                                                                <p>{{ $review->content }}</p>

                                                                @if ($review->product_review_images->isNotEmpty())

                                                                    <div class="my-3">
                                                                        @foreach ($review->product_review_images as $image)
                                                                            <img class="mt-2" src="{{ asset($image->image) }}" alt="Review Image" height="100" width="100">
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach


                                                        @if ($key < count($product->product_reviews) - 1)
                                                            <hr>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="just-for-you related_products_container col-lg-4 col-xl-4 col-md-12 col-sm-12 bg-white border-start">
                <div class="py-4 ">
                    <h5 class="my-2 c-left-related-product">
                        @if (session()->get('language') == 'bangla')
                            সংশ্লিষ্ট পণ্য
                        @else
                            Related Products
                        @endif
                    </h5>
                    <hr>
                    <div class="row g-2">
                        @if (count($relatedProduct) > 0)
                            <style>
                                @media (min-width: 668px) and (max-width: 1920px) {
                                    .buy_now {
                                        width: 76px;
                                        font-size: 14px;
                                    }

                                    .add_to_cart {
                                        width: 89px;
                                        font-size: 14px;
                                    }
                                }
                            </style>
                            @foreach ($relatedProduct->take(4) as $r_product)
                                @php $data = calculateDiscount($r_product->id) @endphp

                                @php
                                    $aggregates = $r_product->product_review_aggregates->first();
                                    $review_count = 0;
                                    $review_sum = 0;
                                    $avaRanting = 0;
                                    $avaRantingPar = 0;
                                    if ($aggregates) {
                                        $review_count = $aggregates->review_count;
                                        $review_sum = $aggregates->total_rating;
                                        $avaRanting = ($review_sum / $review_count) * 1.0;
                                        $avaRantingPar = ($avaRanting * 100) / 5;
                                    }
                                @endphp

                                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                    <div class="product_grid card b-0">
                                        @if ($r_product->discount_price != 0)
                                            <div
                                                class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                                {{ $data['text'] }}</div>
                                        @endif

                                        <div class="card-body p-0">
                                            <div class="shop_thumb position-relative">
                                                <a class="card-img-top d-block overflow-hidden"
                                                    href="{{ route('product.details', $r_product->slug) }}"><img
                                                        class="card-img-top"
                                                        src="{{ asset($r_product->product_thumbnail) }}"
                                                        alt="..."></a>
                                                <div class="product-left-hover-overlay">
                                                    <ul class="left-over-buttons">
                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                class="d-inline-flex circle align-items-center justify-content-center"><i
                                                                    class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                                        </li>
                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                                    class="far fa-heart position-absolute"></i></a></li>
                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                                    class="fas fa-shopping-basket position-absolute"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                            <div class="text-left">
                                                <div class="text-left mb-1">
                                                    <!--<div-->
                                                    <!--    class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">-->
                                                    <!--    <div class="back-stars">-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <i class="fas fa-star up-star"></i>-->
                                                    <!--        <div class="front-stars" style="width:{{ $avaRantingPar }}%">-->
                                                    <!--            <i class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--            <i class="fa fa-star down-star" aria-hidden="true"></i>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--    <span class=""-->
                                                    <!--        style="font-size: 16px">({{ $review_count > 1 ? $review_count . ' Reviews' : $review_count . ' Review' }})</span>-->
                                                    <!--</div>-->
                                                    <h5 class="product_name fs-md mb-1 lh-1" style="margin: 0;">
                                                        <a href="{{ route('product.details', $r_product->slug) }}">
                                                            {{ Str::limit($r_product->name_en, 38, '...') }}
                                                        </a>
                                                    </h5>
                
                                                    @if ($r_product->discount_price != 0)
                                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                                            <span class="fw-bold fs-lg" style="font-weight: 500; color: #0f188d">৳{{ $data['discount'] }}</span>
                                                            <del class="text-muted fs-sm mb-0">৳{{ $r_product->regular_price }}</del>
                                                        </div>
                                                    @else
                                                        <span class="fw-bold fs-lg mt-1" style="font-weight: 500; color: #0f188d">৳{{ $r_product->regular_price }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-center mb-1 p-0">
                                                    @if ($r_product->stock_qty == 0)
                                                        <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                                    @elseif($r_product->is_varient == 1)
                                                        <!--<button type="submit" id="{{ $r_product->id }}"-->
                                                        <!--    onclick="productView(this.id)"data-bs-toggle="modal"-->
                                                        <!--    data-bs-target="#quickViewModal"-->
                                                        <!--    style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"-->
                                                        <!--    class="buy_now btn btn-outline-dark">-->
                                                        <!--    @if (session()->get('language') == 'bangla')-->
                                                        <!--        এখুনি কিনুন-->
                                                        <!--    @else-->
                                                        <!--        Buy Now-->
                                                        <!--    @endif-->
                                                        <!--</button>-->
                                                        <!--<button type="submit" id="{{ $r_product->id }}"-->
                                                        <!--    onclick="productView(this.id)"data-bs-toggle="modal"-->
                                                        <!--    data-bs-target="#quickViewModal"-->
                                                        <!--    style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"-->
                                                        <!--    class="add_to_cart btn btn-outline-dark">-->

                                                        <!--    @if (session()->get('language') == 'bangla')-->
                                                        <!--        কার্টে যোগ করুন-->
                                                        <!--    @else-->
                                                        <!--        Add to Cart-->
                                                        <!--    @endif-->
                                                        <!--</button>-->
                                                    @else
                                                        <input type="hidden" id="pfrom" value="direct">
                                                        <input type="hidden" id="product_product_id"
                                                            value="{{ $r_product->id }}" min="1">
                                                        <input type="hidden" id="{{ $r_product->id }}-product_pname"
                                                            value="{{ $r_product->name_en }}">

                                                        <!--<button type="submit" onclick="buyNow({{ $r_product->id }})"-->
                                                        <!--    class="buy_now btn btn-outline-dark ">Buy Now</button>-->
                                                        <!--<button type="submit"-->
                                                        <!--    onclick="addToCartDirect({{ $r_product->id }})"-->
                                                        <!--    class="add_to_cart btn btn-outline-dark ">Add to Cart</button>-->
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Products Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
   </div>
    <!-- Description Part Start -->

    {{-- Product Review Start --}}
    {{-- <div class="col-md-12 bg-white pl-3 pb-5">
        <div class="container p-0 p-md-2">
            <div class="row">
                <div class="col-md-12 mt-5 p-0">
                    <div class="card-header">
                        <h2>Ratings & Reviews</h2>
                    </div>
                    <div class="overall-rating mb-3 py-5 border-bottom">
                        <div class="row ">
                            <!-- Left Section: Average Rating and Stars -->
                            <div class="col-md-6">
                                <div>
                                    <span class="score-avarage me-2"
                                        style="font-size: 50px; color: black;">{{ $avaRanting_p }}</span>
                                    <span style="font-size: 40px; color: black;">/</span>
                                    <span class="score-max me-3" style="font-size: 50px; color: black;">5</span>
                                </div>
                                <div class="ps-2">
                                    <div class="d-flex align-items-center pl-3">
                                        <div class="star-rating mt-2 me-3 pt2" title="">
                                            <div class="back-stars">
                                                <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                                <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                                <div class="front-stars" style="width: {{ $avaRantingPar_p }}%;">
                                                    <i id="star" class="fa fa-star down-star"
                                                        aria-hidden="true"></i>
                                                    <i id="star" class="fa fa-star down-star"
                                                        aria-hidden="true"></i>
                                                    <i id="star" class="fa fa-star down-star"
                                                        aria-hidden="true"></i>
                                                    <i id="star" class="fa fa-star down-star"
                                                        aria-hidden="true"></i>
                                                    <i id="star" class="fa fa-star down-star"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-2 pl-3" style="color:black">
                                        ({{ $product->product_reviews_count > 1 ? $product->product_reviews_count . ' Reviews' : $product->product_reviews_count . ' Review' }}
                                        )
                                    </div>

                                </div>
                            </div>

                            <!-- Right Section: Smaller Stars -->
                            <div class="col-md-6 pt-5 ">
                                <div class="star-rating-container" style="display: flex; align-items: center; gap: 15px;">
                                    <div class="star-rating mt-2" title="">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 100; font-size: 14px;">
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="position: relative; width: 150px; height: 12px;">
                                        <!-- Bottom Bar (Gray) -->
                                        <div
                                            style="width: 100%; height: 12px; background-color: #d4d2c5; position: absolute; top: 0; left: 0;">
                                        </div>

                                        @php
                                            $five_percentage = 0;
                                            if ($product->product_reviews_count > 0 && $five_star > 0) {
                                                $five_percentage = ($five_star * 100) / $product->product_reviews_count;
                                            }
                                        @endphp

                                        <!-- Top Bar (Yellow) -->
                                        <div
                                            style="width: {{ $five_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; z-index: 1;">
                                        </div>
                                    </div>




                                    <span>({{ $five_star }})</span>
                                </div>

                                <div class="star-rating-container" style="display: flex; align-items: center; gap: 15px;">
                                    <div class="star-rating mt-2" title="">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 80%; font-size: 14px;">
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="position: relative;">
                                        <div class="bottom-div"
                                            style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                        </div>
                                        @php
                                            $four_percentage = 0;
                                            if ($product->product_reviews_count > 0 && $four_star > 0) {
                                                $four_percentage = ($four_star * 100) / $product->product_reviews_count;
                                            }
                                        @endphp
                                        <div class="top-div"
                                            style="width: {{ $four_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                        </div>
                                    </div>

                                    <span>({{ $four_star }})</span>
                                </div>

                                <div class="star-rating-container" style="display: flex; align-items: center; gap: 15px;">
                                    <div class="star-rating mt-2" title="">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 60%; font-size: 14px;">
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="position: relative;">
                                        <div class="bottom-div"
                                            style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                        </div>
                                        @php
                                            $three_percentage = 0;
                                            if ($product->product_reviews_count > 0 && $three_star > 0) {
                                                $three_percentage =
                                                    ($three_star * 100) / $product->product_reviews_count;
                                            }
                                        @endphp
                                        <div class="top-div"
                                            style="width: {{ $three_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                        </div>
                                    </div>

                                    <span>({{ $three_star }})</span>
                                </div>

                                <div class="star-rating-container" style="display: flex; align-items: center; gap: 15px;">
                                    <div class="star-rating mt-2" title="">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star"class="fa fa-star up-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 40%; font-size: 14px;">
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="position: relative;">
                                        <div class="bottom-div"
                                            style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                        </div>
                                        @php
                                            $two_percentage = 0;
                                            if ($product->product_reviews_count > 0 && $two_star > 0) {
                                                $two_percentage = ($two_star * 100) / $product->product_reviews_count;
                                            }
                                        @endphp
                                        <div class="top-div"
                                            style="width: {{ $two_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0; left: 0; padding: 0px">

                                        </div>
                                    </div>

                                    <span>({{ $two_star }})</span>
                                </div>

                                <div class="star-rating-container" style="display: flex; align-items: center; gap: 15px;">
                                    <div class="star-rating mt-2" title="">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>
                                            <i id="f-star" class="fa fa-star up-star" aria-hidden="true"></i>

                                            <div class="front-stars" style="width: 20%; font-size: 14px;">
                                                <i id="star" class="fa fa-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                                <i id="star" class="fa fa-star down-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="position: relative;">
                                        <div class="bottom-div"
                                            style="width: 150px; height: 12px; background-color: #d4d2c5;">
                                        </div>
                                        @php
                                            $one_percentage = 0;
                                            if ($product->product_reviews_count > 0 && $one_star > 0) {
                                                $one_percentage = ($one_star * 100) / $product->product_reviews_count;
                                            }
                                        @endphp
                                        <div class="top-div"
                                            style="width: {{ $one_percentage * 1.5 }}px; height: 12px; background-color: #FFD700; position: absolute; top: 0px; left: 0; padding: 0px">

                                        </div>
                                    </div>

                                    <span>({{ $one_star }})</span>
                                </div>
                            </div>
                        </div>
                    </div>



                    @if ($product->product_reviews->isNotEmpty())
                        <div class="card-header pb-4 border-bottom">
                            <h4>Product Reviews</h4>
                        </div>
                    @else
                        <div class="card-header border-bottom">
                            <h4 class="p-0 m-0">No Reviews</h4>
                        </div>
                    @endif


                    @if ($product->product_reviews->isNotEmpty())
                        @foreach ($product->product_reviews as $key => $review)
                            @php

                                $ratingPar = ($review->rating * 100) / 5;
                            @endphp

                            <div class="rating-group mb-4 mt-3 position-relative">
                                <!-- Top-right time -->
                                <div class="position-absolute top-0 end-0">
                                    <span class="text-muted"
                                        style="font-size: 14px;">{{ $review->created_at->format('d M, Y') }}</span>
                                </div>
                                <!-- User Name -->
                                <span style="font-weight: 600">{{ $review->user_name }}</span>
                                <!-- Star Rating -->
                                <div class="star-rating mt-2" title="">
                                    <div class="back-stars" style="font-size: 14px;">
                                        <i class="fa fa-star up-star" aria-hidden="true"></i>
                                        <i class="fa fa-star up-star" aria-hidden="true"></i>
                                        <i class="fa fa-star up-star" aria-hidden="true"></i>
                                        <i class="fa fa-star up-star" aria-hidden="true"></i>
                                        <i class="fa fa-star up-star" aria-hidden="true"></i>

                                        <div class="front-stars" style="font-size: 14px; width: {{ $ratingPar }}%; ">
                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review Text -->
                                <div class="my-3">
                                    <p>{{ $review->review }}</p>
                                </div>

                                @foreach ($product->product_reviews as $review)
                                    <div class="review-item">
                                        <p>{{ $review->content }}</p>

                                        @if ($review->product_review_images->isNotEmpty())
                                            <div class="my-3">
                                                @foreach ($review->product_review_images as $image)
                                                    <img class="mt-2" src="{{ asset($image->image) }}"
                                                        alt="Review Image" height="100" width="100">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach


                                @if ($key < count($product->product_reviews) - 1)
                                    <hr>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Product Review End --}}

@endsection



@push('js')
    <script>
        //Qty Up-Down
        $('.detail-qty').each(function() {
            var qtyval = parseInt($(this).find(".qty-val").val(), 10);

            $('.qty-up').on('click', function(event) {
                event.preventDefault();
                qtyval = qtyval + 1;
                $(this).prev().val(qtyval);
            });

            $(".qty-down").on("click", function(event) {
                event.preventDefault();
                qtyval = qtyval - 1;
                if (qtyval > 1) {
                    $(this).next().val(qtyval);
                } else {
                    qtyval = 1;
                    $(this).next().val(qtyval);
                }
            });
        });

        function addCart(id) {
            var qty = $('.qty-val').val();
            addToCartDirect(id, false, qty);
        }


        {{-- $('#buy_now').on('click', function (){ --}}
        {{--    var qty = $('.qty-val').val(); --}}
        {{--    var id = {{$product->id}}; --}}
        {{--    buyNow(id, qty); --}}

        {{-- }); --}}
    </script>
    <script src="{{ asset('FrontEnd') }}/assect/js/xzoom.js"></script>
    <script src="{{ asset('FrontEnd') }}/assect/js/magnific-popup.js"></script>
    <script src="{{ asset('FrontEnd') }}/assect/js/setup.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    
    <script>
        //     $(document).ready(function () {
        //         $(".share").hover(
        //             function () {
        //                 $("#shareDropdown").removeClass("d-none");
        //             },
        //             function () {
        //                 $("#shareDropdown").addClass("d-none");
        //             }
        //         );
        //     });
        //
    </script>
    <script>
        $(document).ready(function() {
            $("#shareBtn").click(function(e) {
                e.stopPropagation();
                $("#shareDropdown").toggleClass("d-none");
            });

            $(document).click(function(e) {
                if (!$(e.target).closest("#shareBtn, #shareDropdown").length) {
                    $("#shareDropdown").addClass("d-none");
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".product-nav li", function () {
            let target = $(this).data("area");   // get data-area value
            let section = $("#" + target);       // find section by ID
        
            if (section.length) {
                $("html, body").animate({
                    scrollTop: section.offset().top - 100 // adjust 100 for navbar height if needed
                }, 600); // 600ms = smooth scroll
            }
        });
        </script>
@endpush
