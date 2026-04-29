@extends('FrontEnd.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid pt-5 page-header">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 fw-bold">{{get_setting('site_name')->value}}</h2>
                    <h5 class="display-6 fw-semibold">Happy Shopping</h5>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="m-0"><a href="{{route('home')}}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Contact Us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Information Start -->
    <section class="container">
        <div class="pt-5">
            <div class="text-center">
                <h1 class="mb-5">Contact For Any Query</h1>
                <h4 class="text-success">{{session('message')}}</h4>
            </div>
            <div class="row mt-5 g-5">
                <div class="col-lg-4 col-md-6">
                    <h3>Get In Touch</h3>
                    <p class="contact-text mb-4 mt-4">{{get_setting('short_description')->value}}
                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-dark"
                                 style="width: 50px; height: 50px;">
                                <i class="fa fa-map-marker-alt text-white fs-4"></i>
                            </div>
                            <div class="mx-2">
                                <p class="mb-0">{{ get_setting('business_address')->value }}</p>
                            </div>
                        </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-dark"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="mx-2">
                            <p>{{get_setting('phone')->value}}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-dark"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="mx-2">
                            <p>{{get_setting('email')->value}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 pt-5">
                    <form action="{{route('message.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Write Your Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="email">Your Email</label><span class="text-danger">*</span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Write Your Email" required>
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <label for="subject" class="pt-2">Subject</label><span class="text-danger">*</span>
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Write Your Subject" required>
                                    @error('subject')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose" class="form-label pt-2">Purpose <span class="text-danger">*</span></label>
                                    <select name="purpose" id="purpose" class="form-control" required>
                                        <option value="" selected disabled>Select Purpose</option>
                                        <option value="complain">Complain</option>
                                        <option value="suggestion">Suggestion</option>
                                        <option value="affiliation">Affiliation</option>
                                        <option value="contact">Contact</option>
                                    </select>
                                    @error('purpose')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <label for="message" class="pt-2">Message</label><span class="text-danger">*</span>
                                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Write a message here" id="message"
                                                  style="height: 150px" required></textarea>
                                    @error('message')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <button class="btn btn-dark py-3 px-5 text-white" type="submit">Send Message</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information End-->
@endsection

