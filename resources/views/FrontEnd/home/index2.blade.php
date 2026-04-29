@extends('FrontEnd.master')
@section('title')
    Home
@endsection
@section('content')
    @push('css')
        <style>
            @media (max-width: 667px) {}

            @media (min-width: 668px) and (max-width: 1920px) {}

            .ytp-chrome-top-buttons {store-find
                display: none !important;
            }

            .middle-banner-wrapper {
                height: 300px;
            }

            /*@media (max-width: 768px) {*/
            /*    .middle-banner-wrapper {*/
            /*        height: 250px;*/
            /*    }*/
            /*}*/

            @media (max-width: 500px) {
                .middle-banner-wrapper .tags_explore h3 {
                    font-size: 17px;
                }

                .middle-banner-wrapper .tags_explore p {
                    font-size: 13px;
                    line-height: 1rem;
                    margin-top: 10px;
                }

                .middle-banner-wrapper .tags_explore {
                    padding: 5px 0px;
                }
            }

            @media (min-width: 1200px) {
                .col-xl-5th {
                    flex: 0 0 20%;
                    max-width: 20%;
                    padding-right: 0px;
                }
            }
            .product_grid.card {
                transition: opacity 0.3s;
            }
            .product_grid.card:hover {
                opacity: 0.9 !important;
            }
            
            .product_grid, .product_grid.card {
                margin-bottom: 15px;
            }
        </style>
        <style>
            .review-carousel {
                display: block;
            }

            .review-item {
                text-align: center;
                margin: 10px;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background: #fff;
            }

            .testimonial-carousel {
                position: relative;
                padding: 50px 0px;
            }

            .testimonial-slider {
                display: flex;
                overflow: hidden;
            }

            .review-carousel {
                display: flex;
                min-height: 220px;
            }

            .testimonial-card {
                width: 100%;
                padding: 20px;
                text-align: center;
            }

            .testimonial-card img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 10px;
            }

            .testimonial-card h5 {
                font-weight: 600;
                margin-bottom: 10px;
            }

            .testimonial-card p {
                font-size: 14px;
                color: #666;
            }

            .slick-prev,
            .slick-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 40px;
                height: 40px;
                background: white;
                border-radius: 50%;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                z-index: 1000;
            }

            .home-slider .slick-prev,
            .home-slider .slick-next {
                background: transparent;
                box-shadow: none;
            }

            .slick-prev {
                left: -15px;
            }

            .slick-next {
                right: -15px;
            }

            .slick-prev:before,
            .slick-next:before {
                font-size: 18px;
                color: black;
            }

            @media (max-width: 768px) {
                .slick-prev {
                    left: -30px;
                }

                .slick-next {
                    right: -30px;
                }
                
                .product_grid, .product_grid.card {
                    margin-bottom: 10px;
                }
                
                 .cat-items-wrap {
                    display: inline-block;
                }
                
                .cat-item {
                    width: 33% !important;
                    float: left;
                }
                
                .cat-name-label {
                    font-weight: 400;
                    font-size: 10px;
                }
                
                .seo-content {
                    margin-top: 50px;
                }
            }
        </style>

        <style>
            .category-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .category-item {
                position: relative;
                padding: 10px;
            }

            .subcategory-list {
                display: none;
                position: absolute;
                right: 100%;
                top: 0;
                background: white;
                border: 1px solid #ddd;
                min-width: 200px;
                padding: 10px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 10000;
            }

            .category-item:hover .subcategory-list {
                display: block;
            }

            .home-slider {
                position: relative;
                z-index: 1;
            }
            
           
            
           
        </style>
    @endpush
    <!-- ======================= Category & Slider ======================== -->
    <section class="p-0 bg-color-all">
        <div class="container">
            <div class="row">

                {{-- <div class="d-none d-lg-block col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="killore-new-block-link border mb-3 mt-3">
                        <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>

                        <div class="killore--block-link-content">
                            <ul>
                                @foreach ($featured_category as $category)
                                    <li><a href="{{route('product.category', $category->slug)}}"><img src="{{asset($category->image)}}" class="rounded-circle mx-2" height="25px" width="25px" alt="">
                                        <span style="position: relative; top: 2px">{{$category->name_en}}</span></a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div> --}}





                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    <div class="home-slider auto-slider mb-3 mt-3">

                        @foreach ($sliders as $slider)
                            <div class="item slider_img" style="background-image:url({{ asset($slider->slider_img) }});">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ $slider->slider_url }}">
                                                <div class="home-slider-container">

                                                    <!-- Slide Title -->
                                                    <div class="home-slider-desc">
                                                        <div class="home-slider-title mb-4">
                                                            <h1
                                                                class="mb-2 ft-bold {{ $slider->title_en ? '' : 'invisible' }}">
                                                                {{ $slider->title_en ? $slider->title_en : 'New Gadgets are Available' }}
                                                            </h1>
                                                            <span
                                                                class="trending {{ $slider->title_en ? '' : 'invisible' }}">{{ $slider->description_en ? $slider->description_en : 'Explore your desired products from our vast collections.' }}</span>
                                                        </div>

                                                        {{--                                                    <a href="#" class="btn btn-white stretched-link hover-black">Buy Now<i class="lni lni-arrow-right ml-2"></i></a> --}}
                                                    </div>
                                                    <!-- Slide Title / End -->

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Slide -->
                    </div>
                </div>

                <div class="d-none d-lg-block col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="killore-new-block-link border mb-3 mt-3">
                        <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>

                        <div class="killore--block-link-content bg-white">
                            <ul class="category-list">
                                @foreach ($featured_category->take(7) as $category)
                                    <li class="category-item">
                                        <a href="{{ route('product.category', $category->slug) }}">
                                            <img src="{{ asset($category->image) }}" class="rounded-circle mx-2"
                                                height="25px" width="25px" alt="">
                                            <span>{{ $category->name_en }}</span>
                                        </a>

                                        <!-- Subcategory Dropdown -->
                                        @if ($category->categories->count() > 0)
                                            <ul class="subcategory-list">
                                                @foreach ($category->categories as $subcategory)
                                                    <li>
                                                        <a href="{{ route('product.category', $subcategory->slug) }}">
                                                            {{ $subcategory->name_en }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- ======================= Category & Slider ======================== -->

    <!-- ======================= Flash Sale ======================== -->
    @php

        $campaign = \App\Models\Campaing::where('status', 1)->orderBy('id', 'desc')->first();
        // $campaing_products = $campaign->campaing_products;
        //dd(count($campaing_products));
    @endphp
    @if ($campaign)
        <input type="hidden" name="" id="campaign" value="1">
    @else
        <input type="hidden" name="" id="campaign" value="0">
        @php
            $start_diff = 0;
            $end_diff = 0;
        @endphp
    @endif
    @if ($campaign)

        @php
            $flash_start = date_create($campaign->flash_start);
            $flash_end = date_create($campaign->flash_end);

            $start_diff = $flash_start->getTimestamp() - time();
            $end_diff = $flash_end->getTimestamp() - time();

            $start_diff2 = date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
            $end_diff2 = date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
        @endphp

        @if ($start_diff2->invert == 0 && $end_diff2->invert == 0)
            <section class="middle">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h2 class="off_title">Flash Sale</h2>
                                <h3 class="ft-bold pt-3">Sales Going On</h3>
                                <h5 class="trimmers">
                                    <strong class="text me-2">Ending in: </strong>
                                    <strong id="demo"></strong>
                                </h5>
                            </div>
                        </div>

                    </div>

                    <div class="row align-items-center justify-content-center">
                        @foreach ($campaign->campaing_products as $key => $campaing_product)
                            @if ($key == 4)
                                @php break; @endphp
                            @endif
                            @php
                                $product = \App\Models\Product::find($campaing_product->product_id);
                                $data = calculateDiscount($product->id);
                            @endphp
                            @php
                                $aggregates = $product->product_review_aggregates->first();
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
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6" style="flex: 0 0 20%; max-width: 20%;">
                                <div class="product_grid card b-0">
                                    {{--                                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div> --}}
                                    @if ($product->discount_price != 0)
                                        <div class="badge text-white position-absolute ft-regular ab-right text-upper" style="background: #800080;">
                                            Save: {{ str_replace('Off', '', $data['text']) }}
                                        </div>
                                    @endif

                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden"
                                                href="{{ route('product.details', $product->slug) }}"><img
                                                    class="card-img-top" src="{{ asset($product->product_thumbnail) }}"
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
                                                <div
                                                    class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                    <div class="back-stars">
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <i class="fas fa-star up-star"></i>
                                                        <div class="front-stars" style="width:{{ $avaRantingPar }}%">
                                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="small">({{ $review_count > 1 ? $review_count . ' Reviews' : $review_count . ' Review' }})</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center" style="padding: 8px 10px;">
                                                    <h5 class="product_name fs-md mb-0 lh-1 mb-1" style="padding: 0; margin: 0;">
                                                        <a href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                                    </h5>
                                                    <div class="elis_rty mb-0" style="white-space:nowrap;">
                                                        @if ($product->discount_price != 0)
                                                            <span class="ft-bold text-dark fs-sm">৳{{ $data['discount'] }}</span>
                                                        @else
                                                            <span class="ft-bold text-dark fs-sm">৳{{ $product->regular_price }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="text-center mb-1 p-0">
                                                    @if ($product->stock_qty == 0)
                                                        <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                                    @elseif($product->is_varient == 1)
                                                        <button type="submit" id="{{ $product->id }}"
                                                            onclick="productView(this.id)" data-bs-toggle="modal"
                                                            data-bs-target="#quickViewModal"
                                                            style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                            class="buy_now btn btn-outline-dark">
                                                            @if (session()->get('language') == 'bangla')
                                                                এখুনি কিনুন
                                                            @else
                                                                Buy Now
                                                            @endif
                                                        </button>
                                                        <button type="submit" id="{{ $product->id }}"
                                                            onclick="productView(this.id)" data-bs-toggle="modal"
                                                            data-bs-target="#quickViewModal"
                                                            style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                            class="add_to_cart btn btn-outline-dark">

                                                            @if (session()->get('language') == 'bangla')
                                                                কার্টে যোগ করুন
                                                            @else
                                                                Add to Cart
                                                            @endif
                                                        </button>
                                                    @else
                                                        <input type="hidden" id="pfrom" value="direct">
                                                        <input type="hidden" id="product_product_id"
                                                            value="{{ $product->id }}" min="1">
                                                        <input type="hidden" id="{{ $product->id }}-product_pname"
                                                            value="{{ $product->name_en }}">

                                                        <button type="submit" onclick="buyNow({{ $product->id }})"
                                                            class="buy_now btn btn-outline-dark ">Buy Now</button>
                                                        <button type="submit" onclick="addToCartDirect({{ $product->id }})"
                                                            class="add_to_cart btn btn-outline-dark ">Add to Cart</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center mt-2">
                            <a href="{{ route('campaign.product') }}" class="btn btn-dark w-25 ">View All</a>
                        </div>

                    </div>

                </div>
            </section>
        @endif
    @endif
    <!-- ======================= Flash sale ======================== -->
    {{-- ======================= Marquee content =================== --}}
    <section class="marquee bg-color-all">
        <div class="container">
            <div class="sliding_text_wrap">
                <marquee direction="left">{{ get_setting('homepage_description')->value ?? '' }}</marquee>
            </div>
        </div>
    </section>

    
    <!-- ======================= All old Category code======================== -->
    {{-- <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Latest Categories</h2>
                        <h3 class="ft-bold pt-3">Latest Categories</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                @foreach ($categories as $category)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                        <div class="cats_side_wrap text-center mx-auto mb-3">
                            <div class="sl_cat_01">
                                <div
                                    class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">
                                    <a href="{{ route('product.category', $category->slug) }}" class="d-block"><img
                                            src="{{ asset($category->image) }}" class="img-fluid" width="40"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a
                                        href="{{ route('product.category', $category->slug) }}">{{ $category->name_en }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section> --}}
    <!-- ======================= All old Category code ======================== -->
    <!-- ======================= All new Category ======================== -->
    <section class="middle bg-color-all">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="featured_cat">Featured Categories</h2>
                        <p class="m-blurb">Browse Your Desired Category For Desired Products!</p>
                    </div>
                </div>
            </div>

            <div class="cat-items-wrap">
                @foreach ($categories as $category)
                    <div class="cat-item">
                        <a href="{{ route('product.category', $category->slug) }}" class="cat-item-inner" style="min-height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start;">
                            <span class="cat-icon"><img
                                    src="{{ asset($category->image) }}"
                                    alt="Drone Icon" width="48" height="48"></span>
                            <div class="cat-name-label" style="margin-top:3px; text-align:center; font-weight:bold;">
                                {{ $category->name_en }}
                            </div>
                        </a>
                    </div>
                @endforeach
                {{-- <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/gimbal-48x48.png"
                                alt="Gimbal Icon" width="48" height="48"></span>
                        <p>Gimbal</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/charger-fan-48x48.png"
                                alt="Charger Fan Icon" width="48" height="48"></span>
                        <p>Charger Fan</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/weight-scale-48x48.png"
                                alt="Weight Scale Icon" width="48" height="48"></span>
                        <p>Weight Scale</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/tv-48x48.png"
                                alt="TV Icon" width="48" height="48"></span>
                        <p>TV</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/mobile-phone-48x48.png"
                                alt="Mobile Phone Icon" width="48" height="48"></span>
                        <p>Mobile Phone</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/mobile-phone-accessories-48x48.png"
                                alt="Mobile Accessories Icon" width="48" height="48"></span>
                        <p>Mobile Accessories</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/portable-ssd-48x48.png"
                                alt="Portable SSD Icon" width="48" height="48"></span>
                        <p>Portable SSD</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/portable-ip-camera-48x48.png"
                                alt="Portable WiFi Camera Icon" width="48" height="48"></span>
                        <p>Portable WiFi Camera</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/trimmer-48x48.png"
                                alt="Trimmer Icon" width="48" height="48"></span>
                        <p>Trimmer</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/smart-watch-48x48.png"
                                alt="Smart Watch Icon" width="48" height="48"></span>
                        <p>Smart Watch</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/action-camera-48x48.png"
                                alt="Action Camera Icon" width="48" height="48"></span>
                        <p>Action Camera</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/earphone-48x48.png"
                                alt="Earphone Icon" width="48" height="48"></span>
                        <p>Earphone</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/earbuds-48x48.png"
                                alt="Earbuds Icon" width="48" height="48"></span>
                        <p>Earbuds</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/bt-speaker-48x48.png"
                                alt="Bluetooth Speakers Icon" width="48" height="48"></span>
                        <p>Bluetooth Speakers</p>
                    </a>
                </div>
                <div class="cat-item">
                    <a href="#" class="cat-item-inner">
                        <span class="cat-icon"><img
                                src="https://www.startech.com.bd/image/cache/catalog/category-thumb/gaming-console-48x48.png"
                                alt="Gaming Console Icon" width="48" height="48"></span>
                        <p>Gaming Console</p>
                    </a>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ======================= All Category ======================== -->


    <!-- ======================= Products Lists ======================== -->
    {{-- <section class="space min pt-0">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4"
                        id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="all-tab" href="#all" data-bs-toggle="tab"
                                role="tab" aria-controls="all" aria-selected="true">All</a>
                        </li>
                        @foreach ($tab_categories as $category)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="{{ $category->id }}-tab" href="#{{ $category->id }}"
                                    data-bs-toggle="tab" role="tab" aria-controls="{{ $category->id }}"
                                    aria-selected="true">{{ $category->name_en }}</a>
                            </li>
                        @endforeach

                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="tab_product">
                                <div class="row rows-products">
                                    @foreach ($tab_categories as $category)
                                        @php $cat_products = get_tab_category_products($category->slug) @endphp
                                        @if (count($cat_products) > 0)
                                            @php $i=1; @endphp
                                            @foreach ($cat_products as $product)
                                                @if ($i == 2)
                                                    @php break; @endphp
                                                @endif
                                                @php $data = calculateDiscount($product->id) @endphp

                                                @php
                                                    $aggregates = $product->product_review_aggregates->first();
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

                                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                                    <div class="product_grid card b-0">
                                                        @if ($product->discount_price != 0)
                                                            <div
                                                                class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                                                {{ $data['text'] }}</div>
                                                        @endif

                                                        <div class="card-body p-0">
                                                            <div class="shop_thumb position-relative">
                                                                <a class="card-img-top d-block overflow-hidden"
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        class="card-img-top"
                                                                        src="{{ asset($product->product_thumbnail) }}"
                                                                        alt="..."></a>
                                                                <div class="product-left-hover-overlay">
                                                                    <ul class="left-over-buttons">
                                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                                class="d-inline-flex circle align-items-center justify-content-center"><i
                                                                                    class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                                                        </li>
                                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                                class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                                                    class="far fa-heart position-absolute"></i></a>
                                                                        </li>
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
                                                                    <div
                                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                                        <div class="back-stars">
                                                                            <i class="fas fa-star up-star"></i>
                                                                            <i class="fas fa-star up-star"></i>
                                                                            <i class="fas fa-star up-star"></i>
                                                                            <i class="fas fa-star up-star"></i>
                                                                            <i class="fas fa-star up-star"></i>
                                                                            <div class="front-stars"
                                                                                style="width:{{ $avaRantingPar }}%">
                                                                                <i class="fa fa-star down-star"
                                                                                    aria-hidden="true"></i>
                                                                                <i class="fa fa-star down-star"
                                                                                    aria-hidden="true"></i>
                                                                                <i class="fa fa-star down-star"
                                                                                    aria-hidden="true"></i>
                                                                                <i class="fa fa-star down-star"
                                                                                    aria-hidden="true"></i>
                                                                                <i class="fa fa-star down-star"
                                                                                    aria-hidden="true"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span
                                                                            class="small">({{ $review_count > 1 ? $review_count . ' Reviews' : $review_count . ' Review' }})</span>
                                                                    </div>
                                                                    <h5 class="product_name fs-md mb-0 lh-1 mb-1"><a
                                                                            href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                                                    </h5>
                                                                    <div class="elis_rty ">
                                                                        @if ($product->discount_price != 0)
                                                                            <del>৳{{ $product->regular_price }}</del>
                                                                            <span
                                                                                class="ft-bold text-dark fs-sm">৳{{ $data['discount'] }}</span>
                                                                        @else
                                                                            <span
                                                                                class="ft-bold text-dark fs-sm">৳{{ $product->regular_price }}</span>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div class="text-center mb-1 p-0">
                                                                    @if ($product->stock_qty == 0)
                                                                        <div class="bg-danger text-white out_of_stock">Out
                                                                            of Stock</div>
                                                                    @elseif($product->is_varient == 1)
                                                                        <button type="submit" id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal"
                                                                            style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                                            class="buy_now btn btn-outline-dark">
                                                                            @if (session()->get('language') == 'bangla')
                                                                                এখুনি কিনুন
                                                                            @else
                                                                                Buy Now
                                                                            @endif
                                                                        </button>
                                                                        <button type="submit" id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal"
                                                                            style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                                            class="add_to_cart btn btn-outline-dark">

                                                                            @if (session()->get('language') == 'bangla')
                                                                                কার্টে যোগ করুন
                                                                            @else
                                                                                Add to Cart
                                                                            @endif
                                                                        </button>
                                                                    @else
                                                                        <input type="hidden" id="pfrom"
                                                                            value="direct">
                                                                        <input type="hidden" id="product_product_id"
                                                                            value="{{ $product->id }}" min="1">
                                                                        <input type="hidden"
                                                                            id="{{ $product->id }}-product_pname"
                                                                            value="{{ $product->name_en }}">

                                                                        <button type="submit"
                                                                            onclick="buyNow({{ $product->id }})"
                                                                            class="buy_now btn btn-outline-dark ">Buy
                                                                            Now</button>
                                                                        <button type="submit"
                                                                            onclick="addToCartDirect({{ $product->id }})"
                                                                            class="add_to_cart btn btn-outline-dark ">Add
                                                                            to Cart</button>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @foreach ($tab_categories as $category)
                            <div class="tab-pane fade" id="{{ $category->id }}" role="tabpanel"
                                aria-labelledby="{{ $category->id }}-tab">
                                <div class="tab_product">
                                    @php $cat_products = get_category_products($category->slug) @endphp
                                    <div class="row rows-products">
                                        @if (count($cat_products) > 0)
                                            @foreach ($cat_products as $product)
                                                @php $data = calculateDiscount($product->id) @endphp
                                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                                    <div class="product_grid card b-0">

                                                        @if ($product->discount_price != 0)
                                                            <div
                                                                class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                                                {{ $data['text'] }}</div>
                                                        @endif

                                                        <div class="card-body p-0">
                                                            <div class="shop_thumb position-relative">
                                                                <a class="card-img-top d-block overflow-hidden"
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        class="card-img-top"
                                                                        src="{{ asset($product->product_thumbnail) }}"
                                                                        alt="..."></a>
                                                                <div class="product-left-hover-overlay">
                                                                    <ul class="left-over-buttons">
                                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                                class="d-inline-flex circle align-items-center justify-content-center"><i
                                                                                    class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                                                        </li>
                                                                        <li class="d-none"><a href="javascript:void(0);"
                                                                                class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                                                    class="far fa-heart position-absolute"></i></a>
                                                                        </li>
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
                                                                    <div
                                                                        class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="small">(5 Reviews)</span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between align-items-center" style="padding: 8px 10px;">
                                                                        <h5 class="product_name fs-md mb-0 lh-1 mb-1" style="padding: 0; margin: 0;">
                                                                            <a href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                                                        </h5>
                                                                        <div class="elis_rty mb-0" style="white-space:nowrap;">
                                                                            @if ($product->discount_price != 0)
                                                                                <span class="ft-bold text-dark fs-sm">৳{{ $data['discount'] }}</span>
                                                                            @else
                                                                                <span class="ft-bold text-dark fs-sm">৳{{ $product->regular_price }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center mb-1 p-0">
                                                                        @if ($product->stock_qty == 0)
                                                                            <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                                                        @elseif($product->is_varient == 1)
                                                                            <button type="submit" id="{{ $product->id }}"
                                                                                onclick="productView(this.id)"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#quickViewModal"
                                                                                style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                                                class="buy_now btn btn-outline-dark">
                                                                                @if (session()->get('language') == 'bangla')
                                                                                    এখুনি কিনুন
                                                                                @else
                                                                                    Buy Now
                                                                                @endif
                                                                            </button>
                                                                            <button type="submit" id="{{ $product->id }}"
                                                                                onclick="productView(this.id)"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#quickViewModal"
                                                                                style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                                                class="add_to_cart btn btn-outline-dark">

                                                                                @if (session()->get('language') == 'bangla')
                                                                                    কার্টে যোগ করুন
                                                                                @else
                                                                                    Add to Cart
                                                                                @endif
                                                                            </button>
                                                                        @else
                                                                            <input type="hidden" id="pfrom"
                                                                                value="direct">
                                                                            <input type="hidden" id="product_product_id"
                                                                                value="{{ $product->id }}" min="1">
                                                                            <input type="hidden"
                                                                                id="{{ $product->id }}-product_pname"
                                                                                value="{{ $product->name_en }}">

                                                                            <button type="submit"
                                                                                onclick="buyNow({{ $product->id }})"
                                                                                class="buy_now btn btn-outline-dark ">Buy
                                                                                Now</button>
                                                                            <button type="submit"
                                                                                onclick="addToCartDirect({{ $product->id }})"
                                                                                class="add_to_cart btn btn-outline-dark ">Add
                                                                                to Cart</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center text-danger">
                                                <strong class="">No Products Available</strong>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </section> --}}



    <!-- ======================= Products List ======================== -->
    <!-- ======================= Physical Stores  ======================== -->

   {{-- <section class="bg-color-all" style="padding:14px 0 80px !important">
        <div class="container">
            <div class="m-home store-finder ws-box p-30">
                <div class="row" style="align-items: center">
                    <div class="col-md-7 col-sm-12 info d-fc">
                        <div class="ic-2"><i class="fa-solid fa-location-dot material-icons.lg"></i></div>
                        <div class="txt">
                            <h3>20+ Physical Stores</h3>
                            <p>Visit Our Store &amp; Get Your Desired IT Product!</p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 store-find">
                        <a href="information/contact" class="btn find d-fc">Find
                            Our Store<i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


 <section class="bg-color-all p-0" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="m-home store-finder ws-box p-30">
            <div class="row" style="align-items: center">
                <div class="col-md-7 col-sm-12 info d-fc">
                    <div class="ic-2">
                        <i class="fa-solid fa-location-dot material-icons.lg"></i>
                    </div>
                    <div class="txt">
                        <h3>3+ Outlets</h3>
                        <p>Enjoy Your Best Shopping Experience!</p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 store-find d-flex justify-content-center justify-content-md-end">
                    <a href="{{route('page.contact')}}" class="btn find d-fc ml-0 mt-2">
                        Find Our Store <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- ======================= Physical Stores  ======================== -->

    <!-- ======================= Recently Added ======================== -->
    {{-- <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Recently Added</h2>
                        <h3 class="ft-bold pt-3">Recently Added</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                @foreach ($product_recently_adds as $product)
                    @php $data = calculateDiscount($product->id) @endphp
                    @php
                        $aggregates = $product->product_review_aggregates->first();
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
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                            @if ($product->discount_price != 0)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                    {{ $data['text'] }}</div>
                            @endif

                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"
                                        href="{{ route('product.details', $product->slug) }}"><img class="card-img-top"
                                            src="{{ asset($product->product_thumbnail) }}" alt="..."></a>
                                    <div class="product-left-hover-overlay">
                                        <ul class="left-over-buttons">
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center"><i
                                                        class="fas fa-expand-arrows-alt position-absolute"></i></a></li>
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                        class="far fa-heart position-absolute"></i></a></li>
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                        class="fas fa-shopping-basket position-absolute"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
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
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <span
                                                class="small">({{ $review_count > 1 ? $review_count . ' Reviews' : $review_count . ' Review' }})</span>
                                        </div>
                                        <h5 class="product_name fs-md mb-0 lh-1 mb-1"><a
                                                href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                        </h5>
                                        <div class="elis_rty ">
                                            @if ($product->discount_price != 0)
                                                <del>৳{{ $product->regular_price }}</del>
                                                <span class="ft-bold text-dark fs-sm">৳{{ $data['discount'] }}</span>
                                            @else
                                                <span
                                                    class="ft-bold text-dark fs-sm">৳{{ $product->regular_price }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="text-center mb-1 p-0">
                                        @if ($product->stock_qty == 0)
                                            <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                        @elseif($product->is_varient == 1)
                                            <button type="submit" id="{{ $product->id }}"
                                                onclick="productView(this.id)"data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                class="buy_now btn btn-outline-dark">
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </button>
                                            <button type="submit" id="{{ $product->id }}"
                                                onclick="productView(this.id)"data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                class="add_to_cart btn btn-outline-dark">

                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </button>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <button type="submit" onclick="buyNow({{ $product->id }})"
                                                class="buy_now btn btn-outline-dark ">Buy Now</button>
                                            <button type="submit" onclick="addToCartDirect({{ $product->id }})"
                                                class="add_to_cart btn btn-outline-dark ">Add to Cart</button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section> --}}
    <!-- ======================= Recently Added ======================== -->




    <!-- ======================= Featured Products ======================== -->

   <section class="middle bg-color-all">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h3 class="ft-bold pt-3">Featured Products</h3>
                    <p class="m-blurb">Trending Products People Searching!</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center justify-content-center">
            @foreach ($product_featured as $product)
                @php $data = calculateDiscount($product->id) @endphp
                @php
                    $aggregates = $product->product_review_aggregates->first();
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
                <div class="col-xl-5th col-lg-4 col-md-6 col-6 pr-0">
                    <div class="product_grid card b-0">
                        @if ($product->discount_price != 0)
                            <div class="badge text-white position-absolute ft-regular ab-right text-upper" style="background: #800080;">
                                Save: {{ str_replace('Off', '', $data['text']) }}
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden"
                                   href="{{ route('product.details', $product->slug) }}">
                                    <img class="card-img-top bg-white"
                                         src="{{ asset($product->product_thumbnail) }}"
                                         alt="{{ $product->name_en }}">
                                </a>
                            </div>
                        </div>

                        <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
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

                                {{-- ✅ Stock & Button --}}
                                <div class="text-center mb-1 p-0">
                                    @if ($product->stock_qty == 0)
                                        <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                    @elseif($product->is_varient == 1)
                                        {{-- Varient product buttons hidden --}}
                                    @else
                                        <input type="hidden" id="pfrom" value="direct">
                                        <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                                        <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                                        <!--<button type="submit" onclick="buyNow({{ $product->id }})"-->
                                        <!--        class="buy_now btn btn-outline-dark">Buy Now</button>-->
                                        <!--<button type="submit" onclick="addToCartDirect({{ $product->id }})"-->
                                        <!--        class="add_to_cart btn btn-outline-dark">Add to Cart</button>-->
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

    <!-- ======================= Featured Products ======================== -->









    <!-- ======================= Tag Wrap Start ============================ -->
    {{-- <section class="bg-cover p-0 pb-2">
        <div class="container">
            <div class="row justify-content-center middle-banner-wrapper">
                <div class="col-sm-12 d-flex flex-column flex-md-row gap-md-4 pe-0 ps-0">
                    <div class="w-100 pr-md-2">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube-nocookie.com/embed/{{ get_setting('intro_youtube_video_code')->value }}?si=cUaxk6PrJgIHg1jN&amp;controls=0"
                            title="Introduction Video" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="d-flex align-items-center justify-content-center w-100 ml-md-2 mt-3 mt-md-0"
                        style="background-image: url('{{ asset($half_banner->banner_img) }}'); background-color: #cccccc; background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%">
                        <div class="tags_explore text-center">
                            <h3 class="mb-0 text-white ft-bold">{{ $half_banner->title_en }}</h3>
                            <p class="text-light mb-4">{{ $half_banner->description_en }}</p>
                            <p>
                                <a href="{{ $half_banner->banner_url }}"
                                    class="btn bg-white p-1 px-3 p-md-2 px-md-5 text-dark ft-medium">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ======================= Tag Wrap Start ============================ -->

    <!-- ======================= Trending Products ======================== -->
    {{-- <section class="middle">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">Top Selling Products</h2>
                        <h3 class="ft-bold pt-3">Top Selling Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                @foreach ($product_trendings as $product)
                    @php $data = calculateDiscount($product->id) @endphp

                    @php
                        $aggregates = $product->product_review_aggregates->first();
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

                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            @if ($product->discount_price != 0)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                    {{ $data['text'] }}</div>
                            @endif

                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"
                                        href="{{ route('product.details', $product->slug) }}"><img class="card-img-top"
                                            src="{{ asset($product->product_thumbnail) }}" alt="..."></a>
                                    <div class="product-left-hover-overlay">
                                        <ul class="left-over-buttons">
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center"><i
                                                        class="fas fa-expand-arrows-alt position-absolute"></i></a></li>
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                        class="far fa-heart position-absolute"></i></a></li>
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                        class="fas fa-shopping-basket position-absolute"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
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
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star down-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <span
                                                class="small">({{ $review_count > 1 ? $review_count . ' Reviews' : $review_count . ' Review' }})</span>
                                        </div>
                                        <h5 class="product_name fs-md mb-0 lh-1 mb-1"><a
                                                href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                        </h5>
                                        <div class="elis_rty ">
                                            @if ($product->discount_price != 0)
                                                <del>৳{{ $product->regular_price }}</del>
                                                <span class="ft-bold text-dark fs-sm">৳{{ $data['discount'] }}</span>
                                            @else
                                                <span
                                                    class="ft-bold text-dark fs-sm">৳{{ $product->regular_price }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="text-center mb-1 p-0">
                                        @if ($product->stock_qty == 0)
                                            <!--<div class="bg-danger text-white out_of_stock">Out of Stock</div>-->
                                        @elseif($product->is_varient == 1)
                                            <button type="submit" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                class="buy_now btn btn-outline-dark">
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </button>
                                            <button type="submit" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                class="add_to_cart btn btn-outline-dark">

                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </button>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <button type="submit" onclick="buyNow({{ $product->id }})"
                                                class="buy_now btn btn-outline-dark ">Buy Now</button>
                                            <button type="submit" onclick="addToCartDirect({{ $product->id }})"
                                                class="add_to_cart btn btn-outline-dark ">Add to Cart</button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section> --}}
    <!-- ======================= Trending Products ======================== -->

    <!-- ======================= Tag Wrap Start ============================ -->
    {{-- <section class="bg-cover mb-4"
        style="background-image: url('{{ asset($home_banners->first()->banner_img) }}'); background-color: #cccccc; background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="ht-60"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="tags_explore text-center">
                        <h2 class="mb-0 text-white ft-bold">{{ $home_banners->first()->title_en }}</h2>
                        <p class="text-light fs-lg mb-4">{{ $home_banners->first()->description_en }}</p>
                        <p>
                            <a href="{{ $home_banners->first()->banner_url }}"
                                class="btn btn-lg bg-white px-5 text-dark ft-medium">Shop Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-60"></div>
    </section> --}}
    <!-- ======================= Tag Wrap Start ============================ -->

    <!-- ======================= Blog Start ============================ -->
    {{-- <section class="space min d-none">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h2 class="off_title">New Updates</h2>
                        <h3 class="ft-bold pt-3">New Updates</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="_blog_wrap">
                        <div class="_blog_thumb mb-2">
                            <a href="blog-detail.html" class="d-block"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/bl-1.png" class="img-fluid rounded"
                                    alt="" /></a>
                        </div>
                        <div class="_blog_caption">
                            <span class="text-muted">26 Jan 2021</span>
                            <h5 class="bl_title lh-1"><a href="blog-detail.html">Let's start bring sale on this saummer
                                    vacation.</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                            <a href="blog-detail.html" class="text-dark fs-sm">Continue Reading..</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="_blog_wrap">
                        <div class="_blog_thumb mb-2">
                            <a href="blog-detail.html" class="d-block"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/bl-2.png" class="img-fluid rounded"
                                    alt="" /></a>
                        </div>
                        <div class="_blog_caption">
                            <span class="text-muted">17 July 2021</span>
                            <h5 class="bl_title lh-1"><a href="blog-detail.html">Let's start bring sale on this saummer
                                    vacation.</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                            <a href="blog-detail.html" class="text-dark fs-sm">Continue Reading..</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="_blog_wrap">
                        <div class="_blog_thumb mb-2">
                            <a href="blog-detail.html" class="d-block"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/bl-3.png" class="img-fluid rounded"
                                    alt="" /></a>
                        </div>
                        <div class="_blog_caption">
                            <span class="text-muted">10 Aug 2021</span>
                            <h5 class="bl_title lh-1"><a href="blog-detail.html">Let's start bring sale on this saummer
                                    vacation.</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                            <a href="blog-detail.html" class="text-dark fs-sm">Continue Reading..</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> --}}
    <!-- ======================= Blog Start ============================ -->


    <!-- ======================= Review Slider Start ============================ -->
    {{-- <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12">
                <div class="multiple-items">
                    @foreach ($productss as $product)
                        @if ($product->rating['total_reviews'] > 0)
                            <div class="product-review-card">
                                <h5 class="text-center">{{ $product->name }}</h5>

                                <!-- Slick Carousel for Reviews -->
                                <div class="review-carousel">
                                    @foreach ($product->product_reviews as $review)
                                        @php
                                            $ratingPar = ($review->rating * 100) / 5;
                                        @endphp

                                        <div class="review-item card p-3">
                                            <span style="font-weight: 600">{{ $review->user_name }}</span>
                                            <div class="star-rating mt-2">
                                                <div class="back-stars" style="font-size: 14px;">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>

                                                    <div class="front-stars" style="width: {{ $ratingPar }}%;">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="mt-2">{{ $review->review }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="container testimonial-carousel ">
        <div class="row">
            <div class="col-12 ">
                <div class="testimonial-slider">

                    <div class="testimonial-card">
                        <h5 class="text-center d-none">{{ $product->name }}</h5>

                        <!-- Slick Carousel for Reviews -->
                        <div class="review-carousel">
                            @foreach ($product_reviews as $product_review)
                                @php
                                    $ratingPar = ($product_review->rating * 100) / 5;
                                @endphp

                                <div class="review-item card p-2" style="height: 200px">
                                    <span style="font-weight: 600">{{ $product_review->user_name }}</span>
                                    <div class="star-rating mt-2 d-flex justify-content-center">
                                        <div class="back-stars" style="font-size: 14px;">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>

                                            <div class="front-stars" style="width: {{ $ratingPar }}%;">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="height: 150px">
                                        <p class="mt-2">
                                            {{ $product_review->product ? Str::limit($product_review->product->name_en, 80) : '' }}
                                        </p>
                                    <p class="mt-2">
                                        {{ $product_review->review ? Str::limit($product_review->review, 80) : '' }}
                                    </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <!-- ======================= Instagram Start ============================ -->
    {{-- @if (count($instagram_gallery) > 0)
        <section class="p-0">
            <div class="container-fluid p-0">

                <div class="row no-gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center">
                            <h2 class="off_title">Instagram Gallery</h2>
                            <span
                                class="fs-lg ft-bold theme-cl pt-3">{{ '@' . get_setting('instagram_username')->value }}</span>
                            <h3 class="ft-bold lh-1">From Instagram</h3>
                        </div>
                    </div>
                </div>

                <div class="row no-gutters">
                    @foreach ($instagram_gallery as $instagram)
                        <div class="col">
                            <div class="_insta_wrap">
                                <div class="_insta_thumb">
                                    <a href="{{ $instagram->banner_url ? $instagram->banner_url : 'javascript:void(0);' }}"
                                        target="_blank" class="d-block"><img src="{{ asset($instagram->banner_img) }}"
                                            class="img-fluid" alt="" /></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}
    <!-- ======================= Instagram Start ============================ -->




    <!-- Slick JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> --}}



    <!-- ======================= Review Slider End ============================ -->

    <!-- ============================= Customer Features =============================== -->
    {{-- <section class="px-0 py-3 br-top">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-start py-2">
                        <div class="d_ico">
                            <i class="fas {{ get_setting('footer_feature_1_icon')->value }}"></i>
                        </div>
                        <div class="d_capt">
                            <h5 class="mb-0">{{ get_setting('footer_feature_1_title')->value }}</h5>
                            <span class="text-muted">{{ get_setting('footer_feature_1_subtitle')->value }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-start py-2">
                        <div class="d_ico">
                            <i class="far {{ get_setting('footer_feature_2_icon')->value }}"></i>
                        </div>
                        <div class="d_capt">
                            <h5 class="mb-0">{{ get_setting('footer_feature_2_title')->value }}</h5>
                            <span class="text-muted">{{ get_setting('footer_feature_2_subtitle')->value }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-start py-2">
                        <div class="d_ico">
                            <i class="fas {{ get_setting('footer_feature_3_icon')->value }}"></i>
                        </div>
                        <div class="d_capt">
                            <h5 class="mb-0">{{ get_setting('footer_feature_3_title')->value }}</h5>
                            <span class="text-muted">{{ get_setting('footer_feature_3_subtitle')->value }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-start py-2">
                        <div class="d_ico">
                            <i class="fas {{ get_setting('footer_feature_4_icon')->value }}"></i>
                        </div>
                        <div class="d_capt">
                            <h5 class="mb-0">{{ get_setting('footer_feature_4_title')->value }}</h5>
                            <span class="text-muted">{{ get_setting('footer_feature_4_subtitle')->value }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <!-- ======================= Customer Features ======================== -->
    
    
    <!-- ======================= Feature Section ======================== -->
    <section class="middle bg-color-all">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                {{-- new Category code --}}

                <div class="col-lg-3 col-md-6 col-sm-6 c-card-main">
                    <a href="{{ get_setting('footer_feature_1_link')->value }}">
                        <div class="c-card ws-box">
                            <div class="ic-1"><i class="fa-solid {{ get_setting('footer_feature_1_icon')->value }}"></i></div>
                            <div class="c-card-m-l"><span class="blurb">{{ get_setting('footer_feature_1_title')->value }}</span>
                                <p class="m-hide">{{ get_setting('footer_feature_1_subtitle')->value }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 c-card-main">
                    <a href="{{ get_setting('footer_feature_2_link')->value }}">
                        <div class="c-card ws-box">
                            <div class="ic-1"><i class="fa-regular {{ get_setting('footer_feature_2_icon')->value }}"></i></div>
                            <div class="c-card-m-l"><span class="blurb">{{ get_setting('footer_feature_2_title')->value }}</span>
                                <p class="m-hide">{{ get_setting('footer_feature_2_subtitle')->value }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 c-card-main">
                    <a href="{{ get_setting('footer_feature_3_link')->value }}">
                        <div class="c-card ws-box">
                            <div class="ic-1"><i class="fa-solid {{ get_setting('footer_feature_3_icon')->value }}"></i></div>
                            <div class="c-card-m-l"><span class="blurb">{{ get_setting('footer_feature_3_title')->value }}</span>
                                <p class="m-hide">{{ get_setting('footer_feature_3_subtitle')->value }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 c-card-main">
                    <a href="{{ get_setting('footer_feature_4_link')->value }}">
                        <div class="c-card ws-box">
                            <div class="ic-1"><i class="fa-solid {{ get_setting('footer_feature_4_icon')->value }}"></i></div>
                            <div class="c-card-m-l"><span class="blurb">{{ get_setting('footer_feature_4_title')->value }}</span>
                                <p class="m-hide">{{ get_setting('footer_feature_4_subtitle')->value }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Old Category code --}}
                {{--
                @foreach ($categories as $category)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                        <div class="cats_side_wrap text-center mx-auto mb-3">
                            <div class="sl_cat_01">
                                <div
                                    class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">
                                    <a href="{{ route('product.category', $category->slug) }}" class="d-block"><img
                                            src="{{ asset($category->image) }}" class="img-fluid" width="40"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="sl_cat_02">
                                <h6 class="m-0 ft-medium fs-sm"><a
                                        href="{{ route('product.category', $category->slug) }}">{{ $category->name_en }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach --}}

            </div>

        </div>
    </section>
    <!-- ======================= Feature Section ======================== -->
    
    
    <!-- ======================= Home Seo content ======================== -->
    <section class="px-0 py-3 br-top bg-color-all d-none">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="m-home seo-content m-html">
                        <h1>Leading Computer, Laptop &amp; Gaming PC Retail &amp; Online Shop in Bangladesh</h1>
                        <div>
                            <p>Technology has become a part of our daily lives, and we depend on tech products daily for a
                                vast portion of our lives. There is hardly a home in Bangladesh without a tech product. This
                                is where we come in. <a href="https://www.startech.com.bd/">Star Tech Ltd.</a> started as a
                                Tech Product Shop in March 2007. We focus on giving the best customer service in Bangladesh,
                                following our motto of <strong>"Customer Comes First."</strong> This is why Star Tech is the
                                most <strong>trusted computer shop in Bangladesh</strong> today, capturing the loyalty of a
                                large customer base. After a long 16-year journey, Star Tech Ltd. was certified with the
                                renowned "ISO 9001:2015 certification" as a recognition for the best Quality Control
                                Management System. As an <strong>ISO-certified organization</strong>, Star Tech Ltd. is now
                                up to the international standards that specify a Quality Management System (QMS). This
                                Certification denotes that the organization strictly maintains all sorts of regulatory
                                requirements to provide customers with products and services of a global standard.</p>
                            <h2>Best Laptop Shop in Bangladesh</h2>
                            <p>Star Tech is the most popular <a
                                    href="https://www.startech.com.bd/laptop-notebook/laptop">Laptop Brand Shop in BD</a>.
                                Star Tech <a href="https://www.startech.com.bd/laptop-notebook/laptop">Laptop</a> Shop has
                                the perfect device, whether you are a freelancer, officegoer, or student. Gamers love our
                                collection of <a href="https://www.startech.com.bd/laptop-notebook/Gaming-Laptop">Gaming
                                    Laptops</a> because we always bring the latest laptops in Bangladesh. As the best laptop
                                shop in BD, a customer's budget is our first concern. We bring the latest Intel Laptop and
                                AMD Laptop under budget for every customer - from starters to expert users. Star Tech is
                                considered the most trusted laptop shop in BD, allowing you to buy the best laptops from top
                                laptop brands in the world. Along with the best laptop brands, our experts provide you with
                                the best buying decisions based on your needs and budget - making Star Tech the trusted and
                                most popular laptop shop in Bangladesh. Star Tech lets you buy an official Apple <a
                                    href="https://www.startech.com.bd/apple-macbook">MacBook</a> Air or MacBook Pro from <a
                                    href="https://www.startech.com.bd/apple">Apple Store in Bangladesh.</a> Star Tech sells
                                the latest models of the most popular laptop brands, such as - <a
                                    href="https://www.startech.com.bd/laptop-notebook/laptop/razer-laptop">Razer</a>, <a
                                    href="https://www.startech.com.bd/hp-laptop">HP</a>, Dell, <a
                                    href="https://www.startech.com.bd/apple-macbook">Apple MacBook</a>, <a
                                    href="https://www.startech.com.bd/asus-laptop">Asus</a>, <a
                                    href="https://www.startech.com.bd/acer-laptop">Acer</a>, <a
                                    href="https://www.startech.com.bd/lenovo-laptop">Lenovo</a>, <a
                                    href="https://www.startech.com.bd/microsoft-surface-laptop">Microsoft Surface</a>, MSI,
                                Gigabyte, <a href="https://www.startech.com.bd/infinix-laptop">Infinix</a>, <a
                                    href="https://www.startech.com.bd/walton-laptop">Walton</a>, Xiaomi MI, Huawei, Chuwi,
                                etc.</p>
                            <h2>Best Desktop PC Shop In Bangladesh</h2>
                            <p><a href="https://www.startech.com.bd/">Star Tech</a> has the most comprehensive array of <a
                                    href="https://www.startech.com.bd/desktops">Desktop PCs</a>. We offer top-of-the-line
                                Custom PC, <a href="https://www.startech.com.bd/desktops/brand-pc">Brand PC</a>, All-in-One
                                PC, and <a href="https://www.startech.com.bd/desktops/portable-mini-pc">Portable Mini
                                    PC</a> at Star Tech outlets, the trusted and most popular Desktop PC shop in Bangladesh,
                                which are spread nationwide. Get your new iMac Desktop or <a
                                    href="https://www.startech.com.bd/apple-mac-mini">Apple Mac Mini</a> with an
                                international warranty and servicing plan. You can always depend on the Star Tech PC shop
                                experts to build the best desktop PC or computer with parts of your choice. Star Tech is
                                Bangladesh's most reliable repair shop for PC, laptops, &amp; other consumer electronics.
                                Take your gaming or professional content creation to the next level with a large collection
                                of high-end Gaming PC and Editing PC from Star Tech. You can build a complete personal
                                computer with the best desktop PC parts picked by you with our <a
                                    href="https://www.startech.com.bd/tool/pc_builder">PC Builder</a> feature. The features
                                let you <a href="https://www.startech.com.bd/tool/pc_builder">pick PC parts</a> to buy the
                                best desktop PC anytime. Or, you can visit any Star Tech custom PC shop near you to build
                                the best Desktop PC according to your taste, live, and in front of you.</p>
                            <h2>Best Gaming PC Shop In Bangladesh</h2>
                            <p>We at Star Tech love gaming. Therefore, we aim to provide a holistic gaming experience with
                                our best gaming PC shop in Bangladesh, "Star Tech Rig House." The Rig House is a specialized
                                shop for PC builds with high-end PC components. Star Tech Rig House is highly decorated with
                                the best gaming PC parts for customers to build online Gaming or editing PC. Our gaming PC
                                shop in Bangladesh offers the broadest range of Gaming PC, Gaming Laptops, and <a
                                    href="https://www.startech.com.bd/gaming-console">Game Consoles</a> from XBOX &amp;
                                PlayStation. Star Tech's largest Gaming PC shop consists of Gaming Motherboards, Liquid
                                Coolers, Custom Water Cooling for PC, Gaming Casings, high-performance RAM Kits, Graphics
                                Cards, etc. Our exceptional Gaming accessories cover Gaming Chairs, Gaming Sofas, RGB
                                Mousepads, Gaming Headphones, Headphone Stands, RGB Gaming PC Light-Strips and many more. We
                                have strategic partnerships with many world-renowned computer Gaming brands like Razer, PNY,
                                ASRock, Asus, Zadak, GALAX, Noctua, Antec, Lian Li, CRYORIG, EKWB, Gamdias, KWG, XFX, etc.
                                Our gaming concern extends to leading gaming brands, including A4Tech Bloody, SteelSeries,
                                Logitech, Corsair, Redragon, Cooler Master, Fantech, DeepCool, Cougar, Gigabyte &amp; Elgato
                                products at our exclusive Gaming PC Shop.</p>
                            <h2>Best Office Equipment Shop In Bangladesh</h2>
                            <p>Star Tech Ltd. is Bangladesh's most trusted <a
                                    href="https://www.startech.com.bd/office-equipment">Office Equipment </a>Shop. For more
                                than 18 years, we have been providing the best Office Solution. Take a quick drive to the
                                nearest Star Tech retail center and furnish your home office, Start-up business desk, or
                                corporate space with the best <a href="https://www.startech.com.bd/office-equipment">Office
                                    Equipment</a> and office supplies. <a
                                    href="https://www.startech.com.bd/tool/finder">Find Laptops</a>, Desktops, Antiviruses,
                                CCTV &amp; IP Cameras, Printers, Routers, Photocopiers, Attendance Machines, Scanners,
                                Conference Systems, Server Equipment, etc for smooth office operation.</p>
                            <h2>Largest Gadget Shop In Bangladesh</h2>
                            <p>We bring in the most sought <a href="https://www.startech.com.bd/gadget">gadgets </a>at Star
                                Tech. Only genuine and leading brands of <a
                                    href="https://www.startech.com.bd/gadget/smart-watch">Smart Watch</a>, <a
                                    href="https://www.startech.com.bd/earbuds">Earbuds</a>, <a
                                    href="https://www.startech.com.bd/television-startech">TV</a>, <a
                                    href="https://www.startech.com.bd/power-bank">Power Bank</a>, and Mobile Phone
                                Accessories are available at our Gadget Shop. We are also concerned for creative
                                professionals for whom we bring exciting gadgets like Drones, Studio Equipment, <a
                                    href="https://www.startech.com.bd/dslr-camera">DSLR Camera</a>, <a
                                    href="https://www.startech.com.bd/gimbal">Gimbals </a>&amp; Stream Decks from
                                internationally reputed brands like DJI, Blackmagic, Corsair, Zhiyun, Gudsen, and Loupedeck.
                                Star Tech has established the largest gadget shop in BD with the help of an app &amp;
                                E-commerce website. Ease up your chores with Daily Lifestyle gadgets from our gadget shop.
                                Xiaomi, Anker, Micropack, Vention, Fire-Boltt, UGREEN, OnePlus, Apple, Baseus, Orico, Havit,
                                Samsung, and HOCO are a few of the brands we cover.</p>
                            <h2>Top Mobile Shop in Bangladesh</h2>
                            <p>Star Tech <a href="https://www.startech.com.bd/mobile-phone">mobile phone</a> shop offers
                                the latest smartphones and feature phones from top mobile brands. <a
                                    href="https://www.startech.com.bd/samsung-mobile-phone">Samsung</a>, Motorola, Google
                                Pixel, <a href="https://www.startech.com.bd/vivo-mobile-phone">Vivo</a>, Huawei, Xiaomi, <a
                                    href="https://www.startech.com.bd/oppo-mobile-phone">OPPO</a>, Mi, Realme, and <a
                                    href="https://www.startech.com.bd/oneplus-mobile-phone">OnePlus</a> are among the
                                Android smartphone brands at our mobile shop. Star Tech is a one-stop solution for buying <a
                                    href="https://www.startech.com.bd/apple-iphone">iPhones</a> in Bangladesh. Offering
                                extensive warranty, EMI &amp; home delivery service spanning the country, we are the top <a
                                    href="https://www.startech.com.bd/mobile-phone">mobile</a> shop in Bangladesh,
                                presenting the best online shop for mobile phones. Our mobile phone shop has an extensive
                                collection of <a href="https://www.startech.com.bd/mobile-phone-accessories">mobile phone
                                    accessories</a>, including chargers, USB Type C Cables, Power Banks, Wireless Chargers,
                                and many more to go with your smartphone.</p>
                            <h2>Best Home Appliance Shop in Bangladesh</h2>
                            <p>Star Tech is a popular home appliance shop in Bangladesh with a variety of top-quality home
                                appliances including <a href="https://www.startech.com.bd/air-conditioner">air
                                    conditioners</a>, <a href="https://www.startech.com.bd/washing-machine">washing
                                    machines</a>, <a href="https://www.startech.com.bd/oven">ovens</a>, refrigerators, <a
                                    href="https://www.startech.com.bd/geyser-water-heater">geysers</a>, vacuum cleaners, <a
                                    href="https://www.startech.com.bd/sewing-machine">sewing machines</a>, <a
                                    href="https://www.startech.com.bd/room-heater">electric room heaters</a>, and more.
                                Star Tech offers home appliances from renowned brands like Samsung, LG, Hitachi, Whirlpool,
                                Singer, Haier, <a href="https://www.startech.com.bd/walton-ac">Walton</a>, and so on. To
                                assist customers in selecting the appropriate air conditioner, Star Tech has an <a
                                    href="https://www.startech.com.bd/tool/btu_calculator">AC Ton Calculator</a>, helping
                                determine the ideal AC capacity based on room size and other factors. Star Tech focuses on
                                the evolving needs of modern households and ensures best quality Home Appliance at best
                                price in Bangladesh.</p>
                            <h2>Trusted Online Shopping From Bangladesh at The Best E-Commerce Website</h2>
                            <p>Star Tech believes the most in customer satisfaction. To meet the surging demand for online
                                shopping from Bangladesh, we launched our <a
                                    href="https://www.startech.com.bd/">E-Commerce</a> website. our highly trusted online
                                shop has been regarded as one of the best E-Commerce websites with most visits. Star Tech is
                                revolutionizing online shopping in Bangladesh, featuring a brilliant search engine that
                                helps our valued customers find their desired products easily. We have developed the most
                                comprehensive PC Builder App, also integrated into our online retail store. With the PC
                                Builder, you can build your Custom PC for gaming or productivity, save the build, and get an
                                estimated budget, wattage, and detailed performance report. Our E-Commerce platform runs a
                                variety of campaigns and exciting deals on multiple national &amp; international occasions.
                                a few of our most successful events are - Mistery Box, Flash sale, Special offer, Thursday
                                Thunder, Anniversary Special Offer, New Year Offer, 11.11, 12.12 Campaign, and many more. We
                                also arrange special eSports Online Gaming Events and tournaments for Bangladeshi gamers in
                                partnership with renowned <a href="https://www.startech.com.bd/gaming">gaming </a>brands
                                like Razer and Asus ROG.</p>
                            <h3>Best Price, Product, After-sales Customer Service, &amp; Fastest Delivery</h3>
                            <p>Star Tech Ltd. has taken care of its customers since the beginning. Whether a customer is
                                purchasing or inquiring, our customers get the highest priority. We deliver the best product
                                for the best price with extended after-sales support &amp; the highest standard of customer
                                service. We <a href="https://www.startech.com.bd/information/offer">offer </a>your desired
                                product within the fastest delivery timeframe. With our nationwide presence, we cover all 64
                                districts of Bangladesh. Our distribution hubs are located in Dhaka, Chattogram, Khulna,
                                Rangpur, Gazipur, Rajshahi, and Mymensingh. We also have over 15 dedicated <a
                                    href="https://service.startech.com.bd/">service centers</a> and are proud to offer <a
                                    href="https://service.startech.com.bd/home-service">computer home service</a> for the
                                first time in Bangladesh. The plan to expand our operations in other cities is already in
                                motion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Home Seo content ======================== -->
    
    


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".review-carousel").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                dots: false,
                infinite: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // console.log('ok');
            var campaign = $('#campaign').val();
            if (campaign == 1) {
                // console.log('ok');
                // Convert PHP date differences to JavaScript format
                var startDiff = <?php echo $start_diff * 1000; ?>;
                var endDiff = <?php echo $end_diff * 1000; ?>;

                // Set the date we're counting down to based on PHP date differences
                var countDownDateStart = new Date(Date.now() + startDiff);
                var countDownDateEnd = new Date(Date.now() + endDiff);

                // Update the count down every 1 second
                var x = setInterval(function() {
                        // Get today's date and time
                        var now = new Date().getTime();

                        // Choose between start and end dates based on your requirement
                        var countDownDate = (now < countDownDateStart.getTime()) ? countDownDateStart :
                            countDownDateEnd;

                        // Calculate the remaining time
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Output the result in an element with id="demo"
                        // if($('#language_status').val() == 'bangla'){
                        //     var html = `<span>${days}দিন</span> : <span>${hours}ঘন্টা</span> : <span>${minutes}মিনিট</span> : <span>${seconds}সেকেন্ড</span>`;
                        // }
                        //
                        // else{
                        var html = ` <strong>${days} Days ${hours} Hours ${minutes} Minutes </strong>`;
                        // html += `<br><span class="counter-title">Days:</span> <span class="counter-title">Hours:</span> <span class="counter-title">Minutes:</span> <span class="counter-title">Seconds:</span>`;
                        // }


                        // document.getElementById("demo").innerHTML = html;

                        // If the count down is over, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            // document.getElementById("demo").innerHTML = "EXPIRED";
                        }
                    },
                    1000);
            }
        });
    </script>

    <script>
        // Wait for the page to fully load
        window.onload = function() {
            // Set a delay (e.g., 5 seconds) before applying the style
            setTimeout(function() {
                // Select elements with the class 'ytp-chrome-top-buttons'
                const elements = document.querySelectorAll('.ytp-chrome-top-buttons');

                // Loop through and hide each element
                elements.forEach(element => {
                    element.style.display = 'none';
                });
            }, 5000); // Delay time in milliseconds (5000ms = 5 seconds)
        };
    </script>

    <script>
        $(document).ready(function() {
            $(".category-item").hover(function() {
                $(this).find(".subcategory-list").fadeIn(200);
            }, function() {
                $(this).find(".subcategory-list").fadeOut(200);
            });
        });
    </script>
@endpush
