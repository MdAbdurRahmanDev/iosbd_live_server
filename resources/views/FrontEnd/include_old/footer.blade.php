<footer class="container-fluid nav-bg footer wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-3">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img id="my-img" src="{{asset(get_setting('site_logo')->value)}}" alt="logo" class="main-img"
                          style="width: 200px; height: 50px">
                </a>
                <!-- <a class="navbar-brand" href="#">N<span>O</span>ND<span>Ô</span>N</a> -->
                <p class="mt-2">{{get_setting('short_description')->value}}</p>
                <div class="d-flex pt-3">
                    <a class="btn btn-social" href="{{get_setting('facebook_url')->value}}"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-social" href="{{get_setting('instagram_url')->value}}"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-social" href="{{get_setting('twitter_url')->value}}"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-social" href="{{get_setting('youtube_url')->value}}"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-social" href="{{get_setting('linkedin_url')->value}}"><i class="fab fa-linkedin-in"></i></a>
                </div>

            </div>

            <div class="col-6 col-md-6 col-lg-3">
                @if(session()->get('language') == 'bangla')
                <h4 class=" mb-3">আমাদের সাহায্য করতে দিন</h4>
                @else
                <h4 class=" mb-3">Let Us Help You</h4>
                @endif
                <a class="btn btn-link" href="@if(Auth::user() && Auth::user()->role == 3) {{route('dashboard')}} @else {{route('login')}} @endif">
                    @if(session()->get('language') == 'bangla')
                    @if(Auth::user() && Auth::user()->role == 3)ইওর একাউন্ট @else লগইন @endif
                    @else
                    @if(Auth::user() && Auth::user()->role == 3)Your Account @else Log in @endif
                    @endif
                </a>
                @if(session()->get('language') == 'bangla')
                <a class="btn btn-link" href="{{route('page.contact')}}">যোগাযোগ করুন</a>
                @else
                <a class="btn btn-link" href="{{route('page.contact')}}">Contact Us</a>
                @endif
                @if(session()->get('language') == 'bangla')
                <a class="btn btn-link" href="{{route('page.about')}}">আমাদের সম্পর্কে</a>
                @else
                <a class="btn btn-link" href="{{route('page.about')}}">About Us</a>
                @endif
                @if(session()->get('language') == 'bangla')
                <a class="btn btn-link" href="{{route('page.policy')}}">গোপনীয়তা নীতি</a>
                @else
                <a class="btn btn-link" href="{{route('page.policy')}}">Privacy Policy</a>
                @endif
                @if(session()->get('language') == 'bangla')
                <a class="btn btn-link" href="{{route('page.terms')}}">বিধি-নিষেধ এবং শর্তাবলী</a>
                @else
                <a class="btn btn-link" href="{{route('page.terms')}}">Terms & Condition</a>
                @endif
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                @if(session()->get('language') == 'bangla')
                <h4 class=" mb-3">যোগাযোগ
                </h4>
                @else
                <h4 class=" mb-3">Contact</h4>
                @endif
                <p class="mb-1"><i class="fa fa-map-marker-alt me-3"></i>{{get_setting('business_address')->value}}</p>
                <p class="mb-1"><i class="fa fa-phone-alt me-2"></i>{{get_setting('phone')->value}}</p>
                <p class="mb-1"><i class="fa fa-envelope me-2"></i>{{get_setting('email')->value}}</p>

            </div>

            <div class="col-md-6 col-lg-3">
                @if(session()->get('language') == 'bangla')
                <h4 class="mb-3">শুভ কেনাকাটা</h4>
                @else
                <h4 class="mb-3">Happy Shopping</h4>
                @endif
                @if(session()->get('language') == 'bangla')
                <p>ইজি টু লাইফ
                </p>
                @else
                <p>Easy To Life</p>
                @endif
                <div class="d-flex">
                    <div>
                        <a href="#"><img class="btn bg-light payment-img" src="{{asset('FrontEnd')}}/assect/img/resources/payment.png"
                                         alt=""></a>
                    </div>
                    <div>
                        <a href="#"><img class="bg-light w-50 btn ms-2" src="{{asset('FrontEnd')}}/assect/img/resources/play.png"
                                         alt=""></a>
                        <a href="#"><img class="bg-light w-50 btn ms-2 mt-2" src="{{asset('FrontEnd')}}/assect/img/resources/appstore.png"
                                         alt=""></a>
                        <a href="#"><img class="bg-light w-50 btn ms-2 mt-2"
                                         src="{{asset('FrontEnd')}}/assect/img/resources/appgallery.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="{{route('home')}}">{{get_setting('business_name')->value}}</a> || All Right Reserved.

                    Designed By || <a class="border-bottom" href="https://skydreamit.com/" target="_blank">Sky Dream IT</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        {{--                        <a href="#">Ad's Choice</a>--}}
                        {{--                        <a href="#">Cookies</a>--}}
                        <a href="{{route('page.help')}}">Help</a>
                        <a href="{{route('page.faq')}}">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
