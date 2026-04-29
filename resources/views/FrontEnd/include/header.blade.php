<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Top Header -->

<div class="py-0 py-md-2 br-bottom top-header">
    <div class="container">
        <div class="row">

        {{--    @if (get_setting('is_free_shipping_available')->value == 1) --}}
                <!--<div class="col-xl-7 col-lg-6 col-md-6 col-sm-12">-->
                <div class="col-4 d-flex align-items-center">
                    <div class="top_second">
                        <!--<p class="medium text-muted m-0 p-0"><i class="ti-truck mr-1"></i>Get Free delivery from-->
                        <!--    ৳{{ get_setting('free_shipping_purchase_amount')->value }} <a-->
                        <!--        href="{{ route('product.show') }}" class="medium text-dark text-underline">Shop Now</a>-->
                        <!--</p>-->
                        <p class="medium text-muted m-0 p-0">
                            <i class="lni lni-phone"></i>
                            Call Us Now:
                            <strong class="text-dark fs-sm"><a href="tel:{{get_setting('phone')->value}}">{{get_setting('phone')->value}}</a></strong>
                        </p>
                    </div>
                </div>
        {{--    @endif --}}
        
            <div class="col-4">
                <!--<p class="text-center text-dark p-0 m-0">{{get_setting('business_name')->value}}</p>-->
                <img src="{{ asset('FrontEnd/company_name.jpg') }}" style="height: 30px">
            </div>

            <!-- Right Menu -->
            <!--<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">-->
            <div class="col-4 d-flex align-items-center justify-content-end">
                <div class="currency-selector dropdown js-dropdown float-right d-none">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="popup-title" title="Currency"
                        aria-label="Currency dropdown">
                        <span class="hidden-xl-down medium text-muted">Currency:</span>
                        <span class="iso_code medium text-muted">BDT</span>
                        <i class="fa fa-angle-down medium text-muted"></i>
                    </a>
                    <ul class="popup-content dropdown-menu">
                        <li><a title="Euro" href="#" class="dropdown-item medium text-muted">EUR €</a></li>
                        <li class="current"><a title="US Dollar" href="#"
                                class="dropdown-item medium text-muted">USD $</a></li>
                    </ul>
                </div>

                <!-- Choose Language -->

                <div class="language-selector-wrapper dropdown js-dropdown float-right mr-3 d-none">
                    <a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language"
                        aria-label="Language dropdown">
                        <span class="hidden-xl-down medium text-muted">Language:</span>
                        <span class="iso_code medium text-muted">English</span>
                        <i class="fa fa-angle-down medium text-muted"></i>
                    </a>
                    <ul class="dropdown-menu popup-content link">
                        <li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/1.jpg" alt="en" width="16"
                                    height="11" /><span>English</span></a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/2.jpg" alt="fr" width="16"
                                    height="11" /><span>Français</span></a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/3.jpg" alt="de" width="16"
                                    height="11" /><span>Deutsch</span></a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/4.jpg" alt="it" width="16"
                                    height="11" /><span>Italiano</span></a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/5.jpg" alt="es" width="16"
                                    height="11" /><span>Español</span></a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img
                                    src="{{ asset('FrontEnd') }}/assets/img/6.jpg" alt="ar" width="16"
                                    height="11" /><span>اللغة العربية</span></a></li>
                    </ul>
                </div>

                {{-- <div class="currency-selector dropdown js-dropdown float-right mr-3">
                    @if (Auth::user() && Auth::user()->role == 3)
                        <a href="{{ route('dashboard') }}"><i class="lni lni-user mr-1"></i>{{ Auth::user()->name }}</a>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="lni lni-exit mr-1"></i>Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <i class="lni lni-user mr-1"></i><a href="{{ route('login') }}">Sign In </a> /<a
                            href="{{ route('register') }}"> Sign Up</a>
                    @endif
                </div> --}}

                <div class="order-selector dropdown js-dropdown float-right mr-3">
                    <a href="{{ route('order.tracking') }}" class="text-muted medium"><i
                            class="lni lni-map-marker mr-1"></i>Order Tracking</a>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="headd-sty header">
    <div class="container">
        <div class="row position-relative">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="headd-sty-wrap d-flex align-items-center justify-content-between py-2">

                    {{-- Old Code start --}}
                     {{-- <div class="headd-sty-left d-flex align-items-center">
                        <div class="headd-sty-01">
                            <a class="nav-brand py-0" href="{{route('home')}}">
                                <img src="{{asset(get_setting('site_logo')->value)}}" class="logo" alt="" />
                            </a>
                        </div>
                    </div> --}}
                     {{-- <div class="headd-sty-mid">
                        <div class="headd-sty-02 ml-3">
                            <form class="bg-white rounded-md border-bold" action="{{ route('product.search')}}" method="post" style="border-radius: 50px !important">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control custom-height b-0" name="search" id="search-box" placeholder="Search for products..." autocomplete="off" />

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <button class="btn bg-white text-danger custom-height rounded px-3" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                     {{-- <div class="headd-sty-last">
                        <ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
                            <li>
                                <div class="call d-flex align-items-center text-left">
                                    <i class="lni lni-phone fs-xl"></i>
                                    <span class="text-muted small ml-3">Call Us Now:<strong class="d-block text-dark fs-md"><a href="tel:{{get_setting('phone')->value}}">{{get_setting('phone')->value}}</a></strong></span>
                                </div>
                            </li>
                            <li class="d-none">
                                <a href="#" onclick="openWishlist()">
                                    <i class="far fa-heart fs-lg"></i><span class="dn-counter bg-success">2</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('cart.show')}}" >
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i class="fas fa-shopping-basket fs-lg"></i><span class="dn-counter theme-bg cartQty">0</span>
                                        <div class="text-left ml-1"> --}}
                    {{--                                            <div class="text-muted small lh-1">Total</div> --}}
                    {{--                                            @php $cart = get_cart_data() @endphp --}}
                    {{--                                            <div class="primary-text cart-subtotal"><span class="fs-md ft-medium"><span class="prc-currency"></span></span></div> --}}
                     {{-- </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- Old code End --}}

                    {{-- new Change code sharif start --}}
                    <!--<div class="col-xl-1 col-lg-1 col-md-1">-->
                    <div class="">
                        <div class="headd-sty-left d-flex align-items-center">
                            <div class="headd-sty-01">
                                <a class="nav-brand py-0" href="{{ route('home') }}">
                                    <img src="{{ asset(get_setting('site_logo')->value) }}" class="logo"
                                        alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-xl-5 col-lg-5 col-md-5 header-search-wrapper">-->
                    <div class="header-search-wrapper">
                        <div class="headd-sty-mid">
                            <div class="headd-sty-02 ml-3">
                                <form class="bg-white rounded-md border-bold" action="{{ route('product.search') }}"
                                    method="post" style="border-radius: 10px !important">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control custom-height b-0" name="search"
                                            id="search-box" placeholder="Search for products..."
                                            autocomplete="off" />

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <button class="btn bg-white custom-height rounded px-3 py-2"
                                                    type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-xl-6 col-lg-6 col-md-6">-->
                    <div class="">
                        <div class="headd-sty-right">
                            <div class="ht-item q-actions ml-3 d-flex align-items-center justify-content-end">

                                <!--<a href="#" class="ac h-offer-icon d-flex align-items-center call-us-link">-->
                                <!--    <div class="ic"><i class="lni lni-phone fs-xl"></i></div>-->
                                <!--    <div class="ac-content call-us-text">-->
                                <!--        <h5><a class="" href="tel:{{get_setting('phone')->value}}">{{get_setting('phone')->value}}</a></h5>-->
                                <!--        <p>Call Us Now:</p>-->
                                <!--    </div>-->
                                <!--</a>-->

                                <a href="{{route('cart.show')}}" class="ac h-offer-icon d-flex align-items-center">
                                    <div class="ic"><i class="fas fa-shopping-basket fs-lg"></i></div>
                                    <div class="ac-content">
                                        <h5><span class="dn-counter theme-bg cartQty">0</span></h5>
                                        <p class="cart-text">Cart</p>
                                    </div>
                                </a>

                                <div class="ac h-offer-icon d-flex align-items-center user-account-desktop">
                                    <div class="ic"><i class="fa-solid fa-user"></i></div>
                                    <div class="ac-content user-account-content">
                                       @if (Auth::user() && Auth::user()->role == 3)
                                            <h5><a href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a></h5>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                    class="lni lni-exit mr-1"></i>Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}">Sign In </a> /<a
                                                href="{{ route('register') }}"> Sign Up</a>
                                        @endif

                                    </div>
                                </div>
                                
                                <div class="ac h-offer-icon d-flex align-items-center user-account-mobile">
                                    <div class="ic" id="userDropdownToggle" style="cursor: pointer;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                
                                    
                                </div>
                                <div class="ic mobile-search" style="cursor: pointer;" onclick="openSearch()">
                                    <i class="fa-solid fa-search"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="ac-content user-account-content dropdown-menu" style="right: 0; left: auto; top: 75%;">
                        @if (Auth::user() && Auth::user()->role == 3)
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                            <a class="dropdown-item text-dark" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="dropdown-item text-dark" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="lni lni-exit mr-1"></i> Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="dropdown-item text-dark" href="{{ route('login') }}">Sign In</a>
                            <a class="dropdown-item text-dark" href="{{ route('register') }}">Sign Up</a>
                        @endif
                    </div>

                    {{-- new Change code sharif end --}}
                    <div class="mobile_nav d-none">
                        <ul>
                            <li>
                                <a href="#" onclick="openSearch()">
                                    <i class="lni lni-search-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="lni lni-user"></i>
                                </a>
                            </li>
                            <li class="d-none">
                                <a href="#" onclick="openWishlist()">
                                    <i class="lni lni-heart"></i><span class="dn-counter">2</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart.show') }}">
                                    <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Navigation -->
<div class="headerd header-dark head-style-2">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <div class="nav-toggle"></div>
                <div class="nav-menus-wrapper">
                    <ul class="nav-menu">

                    @php
                            $tab_categories = App\Models\Category::orderBy('name_en','asc')->where('status','=',1)->where('category_tab','=',1)->get();
                        @endphp
                            @foreach ($tab_categories as $category)                                
                                
                                <li><a href="{{ route('product.category', $category->slug) }}">{{ $category->name_en ?? $category->name_bn}}</a>

                                    @if ($category->categories->count() > 0)
                                        <ul class="nav-dropdown nav-submenu">
                                            @foreach ($category->categories as $subcategory)
                                                @if(!$subcategory->category_tab)
                                                    <li><a href="{{ route('product.category', $subcategory->slug) }}">{{ $subcategory->name_en ?? $subcategory->name_bn}}</a>
                                                        @if ($subcategory->categories->count() > 0)
                                                            <ul class="nav-dropdown nav-submenu">
                                                                @foreach ($subcategory->categories as $subsubcategory)
                                                                    @if(!$subsubcategory->category_tab)
                                                                        <li><a href="{{ route('product.category', $subsubcategory->slug) }}">{{ $subsubcategory->name_en ?? $subsubcategory->name_bn}}</a></li>
                                                                    @endif
                                                                @endforeach

                                                            </ul>
                                                        @endif

                                                    </li>
                                                @endif
                                            @endforeach                                                    

                                        </ul>
                                    @endif
                                </li>
                                
                            @endforeach


                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
