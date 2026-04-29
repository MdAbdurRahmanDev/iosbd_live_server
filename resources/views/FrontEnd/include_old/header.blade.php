<style>
    .header-down{
        border-bottom: 1px solid #ccc;
    }
    .header-down .menu ul{
        display: flex;
        list-style: none;
        padding: 10px;
    }
    .header-down .menu ul li{
        margin-left: 20px;
    }
    .header-down .menu ul li a{
        font-size: 18px;
    }

</style>
<header>
    <!-- Desktop Nav Star-->
    <section class="d-none d-lg-block">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 left-item">
                        <ul>
                            <li class="d-none"><a data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    @if(session()->get('language') == 'bangla')
                                        সেল করুন |
                                    @else
                                        Become a Seller |
                                    @endif
                                </a>
                            </li>

                        </ul>
                        <ul>
                            <li><a class="text-light" href="#">
                                    @if(session()->get('language') == 'bangla')
                                        সাহায্য দরকার ?
                                    @else
                                        Need Help ?
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a class="text-light" href="#">
                                    @if(session()->get('language') == 'bangla')
                                        আমাদের কল করুন : {{get_setting('phone')->value}}
                                    @else
                                        Call Us: {{get_setting('phone')->value}}
                                    @endif

                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 right-item">
                        <ul>
                            <li><a class="text-light" href="{{ route('order.tracking') }}">
                                    @if(session()->get('language') == 'bangla')
                                        অর্ডার ট্র্যাকিং
                                    @else
                                        Order Tracking
                                    @endif
                                </a></li>
                            <li class="d-none text-light">|</li>
                            <li class="d-none">
                                @if(session()->get('language') == 'bangla')
                                    <a class="language-dropdown" style="color: white;" href="{{ route('english.language') }}">English</a>
                                @else
                                    <a class="language-dropdown" style="color: white;" href="{{ route('bangla.language') }}">বাংলা</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Become a Seller</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('become.a.seller') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;"> Shop owner Name : <span class="text-danger">*</span></label>
                                <input class="form-control" id="shop_name" type="text" required name="shop_owner_name" placeholder="Write vendor Owner name" value="{{old('shop_owner_name')}}">
                                @error('shop_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;"> Shop Name : <span class="text-danger">*</span></label>
                                <input class="form-control" id="shop_name" type="text" name="shop_name" required placeholder="Write vendor shop name" value="{{old('shop_name')}}">
                                @error('shop_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="col-form-label col-md-4" style="font-weight: bold;"> Phone : <span class="text-danger">*</span></label>
                                <input class="form-control" id="phone" type="text" name="phone" required placeholder="Write vendor phone number" value="{{old('phone')}}">
                                @error('phone')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="col-form-label col-md-4" style="font-weight: bold;"> Email : <span class="text-danger">*</span></label>
                                <input class="form-control" id="email" type="email" name="email" required placeholder="Write vendor email address" value="{{old('email')}}">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="address" class="col-form-label col-md-4" style="font-weight: bold;">Address : <span class="text-danger">*</span></label>
                                <input class="form-control" id="address" type="text" name="address" required placeholder="Write vendor address" value="{{old('address')}}">
                                @error('address')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="col-form-label col-md-4" style="font-weight: bold;">Description :</label>
                                <textarea name="description" id="description" cols="5" placeholder="Write vendor description" class="form-control ">{{old('description')}}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image" class="col-form-label" style="font-weight: bold;">Shop Owner: <span class="text-danger">*</span></label>
                                        <input name="shop_profile" class="form-control" required type="file" id="image">
                                        @error('shop_profile')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage2" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image2" class="col-form-label" style="font-weight: bold;">Shop Cover Photo: <span class="text-danger">*</span></label>
                                        <input name="shop_cover" class="form-control" required type="file" id="image2">
                                        @error('shop_cover')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage3" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image3" class="col-form-label" style="font-weight: bold;">Nid Card:</label>
                                        <input name="nid" class="form-control" type="file" id="image3">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage4" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image4" class="col-form-label" style="font-weight: bold;">Trade license:</label>
                                        <input name="trade_license" class="form-control" type="file" id="image4">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-md-6">
                                    <label for="password" class="col-form-label col-md-4" style="font-weight: bold;"> Password : <span class="text-danger">*</span></label>
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Write vendor Password">
                                    <p>(Minimum Length 6) </p>
                                    @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label col-md-6" style="font-weight: bold;" for="rtpassword">Confirm Password: <span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="rtpassword" />
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- form-group// -->

                            {{-- <div class="mb-4">
                                 <div class="custom-control custom-switch">
                                     <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                     <label class="form-check-label cursor" for="status">Status</label>
                                 </div>
                             </div> --}}

                            <div class="row mb-4 justify-content-sm-end">
                                <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- .row // -->
            </div>
            <!-- card body .// -->
        </div>
        <div class="desktop-nav">
            <nav id="navbar_top" class="navbar navbar-expand-lg nav-bg">
                <div class="container">
                    <a class="navbar-brand header-img" href="{{ route('home') }}" >
                        <img id="my-img" src="{{asset(get_setting('site_logo')->value)}}" alt="logo" class="main-img" style="width: 200px">
                    </a>
                    <!-- <a class="navbar-brand" href="#">N<span>O</span>ND<span>Ô</span>N</a> -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="ms-auto d-flex " action="{{ route('product.search')}}" method="post">
                            @csrf
                            <input class="form-control me-2 search-box search" type="text" onfocus="search_result_show()" onblur="search_result_hide()"  name="search" placeholder="Search here..." >
                            <button class="btn search-icon" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('dashboard')}}" title="Dashboard">@if(Auth::user()->profile_image) <img src="{{asset(Auth::user()->profile_image)}}" class="rounded-circle" height="35px" width="35px" alt="no image"> @endif {{Str::before(Auth::user()->name, ' ')}}</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link text-light">|</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                            @guest
                                <li class="nav-item">
                                    @if(session()->get('language') == 'bangla')
                                        <a class="nav-link" href="{{ route('login') }}">লগ ইন
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                                    @endif
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link text-light">|</span>
                                </li>
                                <li class="nav-item">
                                    @if(session()->get('language') == 'bangla')
                                        <a class="nav-link" href="{{ route('register') }}">সাইন আপ</a>
                                    @else
                                        <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                                    @endif
                                </li>
                            @endguest
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('cart.show') }}"><i
                                        class="fa-solid fa-cart-plus"><span class="cartQty">0</span></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="row">
                <div class="col-md-6 m-auto" >
                    <div class="searchProducts" style="position: fixed;z-index: 99999; margin: 0 0 40px 0;"></div>
                </div>
            </div>
        </div>

        <div class="header-down">
            <div class="container">
                <div class="menu">
                    <ul>
                        <li><a href="{{route('home')}}">
                                @if(session()->get('language') == 'bangla')
                                    হোম
                                @else
                                    Home
                                @endif
                            </a></li>
                        <li>|</li>
                        <li><a href="{{route('product.show')}}">
                                @if(session()->get('language') == 'bangla')
                                    শপ
                                @else
                                    Shop
                                @endif
                            </a></li>
                        <li>|</li>
                        <li><a href="{{route('category_list.index')}}">
                                @if(session()->get('language') == 'bangla')
                                    ক্যাটেগরীজ
                                @else
                                    Categories
                                @endif
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Desktop Nav End-->

    <!-- Mobile Nav Start -->
    <section class="d-block d-lg-none">
        <!-- Icon Start -->
        <!-- <div class="header-top mobile-header-top px-2">
            <div class="mobile-header-top-menu">
                <ul>
                    <li><a class="text-light" href="#">Call Us: +88 01700 000000</a></li>
                    <li><a class="text-light" href="#">Order Tracking </a></li>
                </ul>
            </div>
        </div> -->
        <!-- Icon End -->

        <!-- Search Bar Start-->
        <div class="container d-none">

            <form class="d-flex search-box" role="search" action="{{ route('product.search')}}" method="post">
                @csrf
                <input class="form-control" type="search" onfocus="search_result_show()" onblur="search_result_hide()"  name="search" placeholder="Search" aria-label="Search">
                <button class="btn search-icon" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            {{--            <div class="row">--}}
            {{--                <div class="col-md-6 m-auto" >--}}
            {{--                    <div class=" searchProducts" style="position: absolute;z-index: 99999; margin-left: 40px"></div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <!-- Search Bar End-->
        <div class="mobile-nav">
            <nav id="mobile_navbar_top" class="navbar py-2 nav-bg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img
                            src="{{asset(get_setting('site_favicon')->value)}}" alt="logo"
                            style="width: 200px"></a>

                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample">
                        <span style="font-size: 25px;"><i class="fa-solid fa-bars text-light"></i></span>
                    </button>
                </div>
            </nav>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
             aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <a href="{{route('home')}}"><img src="{{asset(get_setting('site_logo')->value)}}" alt=""></a>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="dropdown ">
{{--                    <form class="d-flex " role="search" >--}}
{{--                        @csrf--}}
{{--                        <input class="form-control" type="search" onfocus="search_result_show()" onblur="search_result_hide()"  name="search" placeholder="Search" aria-label="Search">--}}
{{--                        <button class="btn search-icon" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>--}}
{{--                    </form>--}}
                    <form class="d-flex" action="{{ route('product.search')}}" method="post">
                        @csrf
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" >
                        <button class="btn btn-outline-light" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <ul class="navbar-nav mt-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page.about')}}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('product.show')}}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page.contact')}}">Contact Us</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- Button Menu Start -->
        <div>
            <nav class='mobile'>
                <ul>
                    <li><a href='{{route('home')}}'><span><i class="fa-solid fa-house-chimney"></i>
                                </span><span>Home</span></a></li>

                    <li><a href='{{route('product.show')}}'><span><i class="fa-solid fa-bag-shopping"></i>
                                </span><span>Shop</span></a></li>
                    <li><a href='{{ route('cart.show') }}'><span><i class="fa-solid fa-cart-shopping"></i> <small class="cartQty">0</small></span>
                            <span >Cart</span></a> </li>

                    <li><a href='{{route('category_list.index')}}'><span><i class="fa-solid fa-list"></i>
                                </span><span>Categories</span></a></li>

                    <li>
                        @auth
                            <a href='{{ route('dashboard') }}'>
                            <span>
                                <i class="fa-regular fa-user" style="margin-left: 9px;">
                                    </i>
                                </span>
                                <span>Profile</span>
                            </a>
                        @endauth
                        @guest
                            <a href='{{ route('login') }}'>
                            <span>
                                <i class="fa-regular fa-user" style="margin-left: 9px;">
                                    </i>
                                </span>
                                <span>Profile</span>
                            </a>
                        @endguest
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Button Menu End -->
    </section>
    <!-- Mobile Nav End -->

</header>

