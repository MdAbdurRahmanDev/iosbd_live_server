<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Top Header -->

<div class="top-header" style="background-color: #081621; padding: 15px 0; border-bottom: none;">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Mobile Toggle -->
            <div class="col-2 d-md-none d-block">
                <div class="nav-toggle" style="color: white; font-size: 24px; cursor: pointer;">
                    <i class="fas fa-bars"></i>
                </div>
            </div>

            <!-- Logo -->
            <div class="col-xl-2 col-lg-2 col-md-2 col-5">
                <a class="nav-brand py-0 d-block" href="{{ route('home') }}">
                    <img src="{{ asset(get_setting('site_logo')->value) }}" class="logo img-fluid" alt="Logo" style="max-height: 45px;" />
                </a>
            </div>
            
            <!-- Search Bar -->
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-block header-search-wrapper">
                <form action="{{ route('product.search') }}" method="post" class="top-header-search-form m-0 bg-white" style="border-radius: 5px; overflow: hidden;">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control border-0 shadow-none" placeholder="Search" autocomplete="off" style="border-radius: 5px 0 0 5px; height: 42px; padding-left: 15px;" />
                        <div class="input-group-append">
                            <button class="btn btn-search-header bg-white border-0 text-dark px-3" type="submit" style="border-radius: 0 5px 5px 0; height: 42px;"><i class="fas fa-search" style="color: #000;"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Action Items -->
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-block">
                <div class="d-flex align-items-center justify-content-end" style="gap: 25px;">
                    
                    <a href="#" class="top-action-item d-flex align-items-center text-white text-decoration-none">
                        <div class="icon mr-2" style="color: #ef4a23;"><i class="fas fa-gift" style="font-size: 20px;"></i></div>
                        <div class="text text-left">
                            <h6 class="m-0 text-white font-weight-bold" style="font-size: 15px; line-height: 1.2;">Offers</h6>
                            <small class="m-0" style="font-size: 12px; color: #a5b2c2;">Latest Offers</small>
                        </div>
                    </a>

                    <a href="#" class="top-action-item d-flex align-items-center text-white text-decoration-none">
                        <div class="icon mr-2" style="color: #ff9f00;"><i class="fas fa-bolt" style="font-size: 20px;"></i></div>
                        <div class="text text-left">
                            <h6 class="m-0 text-white font-weight-bold" style="font-size: 15px; line-height: 1.2;">19th Deal</h6>
                            <small class="m-0" style="font-size: 12px; color: #a5b2c2;">Special Deals</small>
                        </div>
                    </a>

                    <div class="dropdown">
                        <a href="{{ route('login') }}" class="top-action-item d-flex align-items-center text-white text-decoration-none" id="accountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                            <div class="icon mr-2" style="color: #ef4a23;"><i class="fas fa-user" style="font-size: 20px;"></i></div>
                            <div class="text text-left">
                                <h6 class="m-0 text-white font-weight-bold" style="font-size: 15px; line-height: 1.2;">Account</h6>
                                <small class="m-0" style="font-size: 12px; color: #a5b2c2;">
                                    @if(Auth::user() && Auth::user()->role == 3)
                                        {{ Auth::user()->name }}
                                    @else
                                        Register or Login
                                    @endif
                                </small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                            @if (Auth::user() && Auth::user()->role == 3)
                                <a class="dropdown-item text-dark" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    </div>

                    <a href="https://www.startech.com.bd/tool/pc_builder" class="btn btn-pc-builder text-white font-weight-bold px-3 py-2" style="background-color: #3749bb; border-radius: 5px; font-size: 14px; text-decoration: none;">PC Builder</a>
                </div>
            </div>

            <!-- Mobile Action Items -->
            <div class="col-5 d-md-none d-flex align-items-center justify-content-end">
                <div class="mobile_nav d-block">
                    <ul class="d-flex align-items-center list-unstyled m-0" style="gap: 15px;">
                        <li>
                            <a href="#" onclick="openSearch()" class="text-white">
                                <i class="fas fa-search" style="font-size: 18px;"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.show') }}" class="text-white position-relative">
                                <i class="fas fa-shopping-basket" style="font-size: 18px;"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartQty" style="font-size: 10px;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="text-white">
                                <i class="fas fa-user" style="font-size: 18px;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Start Navigation -->
<div class="headerd bg-white head-style-2 border-bottom" style="box-shadow: 0 2px 4px rgba(0,0,0,0.08);">
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
