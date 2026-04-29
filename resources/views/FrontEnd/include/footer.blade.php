<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="footer_widget w-100">
                    <h3 class="text-center text-white">{{get_setting('business_name')->value}}</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-6 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="footer_widget pt-0">
                        <a href="{{ route('home') }}">
                            <img src="{{asset(get_setting('site_footer_logo')->value)}}" class="img-footer small mb-2" alt="" />
                        </a>

                        <!--<div class="address mt-3">-->
                        <!--    {{get_setting('business_name')->value}}-->
                        <!--</div>-->
                        <div class="address mt-3">
                            {{get_setting('business_address')->value}}
                        </div>
                        <!--<div class="address mt-3">-->
                        <!--    <a href="tel:{{get_setting('phone')->value}}">{{get_setting('phone')->value}}</a><br><a href="mailto:{{get_setting('email')->value}}">{{get_setting('email')->value}}</a>-->
                        <!--</div>-->
                        <div class="address mt-3">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="{{get_setting('facebook_url')->value}}"><i class="lni lni-facebook-filled"></i></a></li>
                                <li class="list-inline-item"><a href="{{get_setting('twitter_url')->value}}"><i class="lni lni-twitter-filled"></i></a></li>
                                <li class="list-inline-item"><a href="{{get_setting('youtube_url')->value}}"><i class="lni lni-youtube"></i></a></li>
                                <li class="list-inline-item"><a href="{{get_setting('instagram_url')->value}}"><i class="lni lni-instagram-filled"></i></a></li>
                                <li class="list-inline-item"><a href="{{get_setting('linkedin_url')->value}}"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-2 col-lg-2 col-md-2 col-sm-6">
                    <div class="footer_widget pt-0">
                        <h4 class="widget_title">Quick Links</h4>
                        <ul class="footer-menu">
                            <li><a href="{{route('page.about')}}">About Us</a></li>
                            <li><a href="{{route('page.contact')}}">Contact Us</a></li>
{{--                            <li><a href="{{route('')}}">Size Guide</a></li>--}}
                            <li><a href="{{route('page.shipping-return')}}">Shipping & Returns</a></li>
                            <li><a href="{{route('page.faq')}}">FAQ's</a></li>
                            <li><a href="{{route('page.policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-6 col-xl-2 col-lg-2 col-md-2 col-sm-6">
                    <div class="footer_widget pt-0">
                        <h4 class="widget_title">Shop</h4>
                        <ul class="footer-menu">
                            @foreach(get_categories() as $key=>$category)
                                @if($key == 5)
                                    @php break; @endphp
                                @endif
                                <li><a href="{{route('product.category', $category->slug)}}">{{$category->name_en}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-6 col-xl-2 col-lg-2 col-md-2 col-sm-6">
                    <div class="footer_widget pt-0">
                        <h4 class="widget_title">Account</h4>
                        <ul class="footer-menu">
                            <li><a href="{{route('dashboard')}}">My Dashboard</a></li>
                            <li><a href="{{route('dashboard')}}">My Profile</a></li>
                            <li><a href="{{route('dashboard')}}">My Orders</a></li>
                            <li><a href="{{route('dashboard')}}">Return Requests</a></li>
                            <li><a href="{{route('order.tracking')}}">Track Order</a></li>
                            <!--<li>-->
                            <!--    @if(Auth::user() && Auth::user()->role == 3)-->
                            <!--        <a href="{{route('dashboard')}}">Dashboard</a>-->
                            <!--    @else-->
                            <!--        <a href="{{route('login')}}">Login</a>-->
                            <!--    @endif-->
                            <!--</li>-->
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget pt-0">
                        <h4 class="widget_title">Subscribe</h4>
                        <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                        <div class="foot-news-last">
                            <form action="{{ route('subscribers.store') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text b-0 text-light"><i class="lni lni-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="address mt-3">
                            <h5 class="fs-sm text-light">Secure Payments</h5>
                            <div class="scr_payment"><img src="{{ asset(get_setting('footer_payment_image')->value ?? '') }}" class="img-fluid" alt="" /></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">Copyright © 2024 | {{get_setting('business_name')->value}} | Developed By <a href="https://skydreamit.com/" target="_blank" style="color: #fff; font-weight: bold">Sky Dream IT</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->
