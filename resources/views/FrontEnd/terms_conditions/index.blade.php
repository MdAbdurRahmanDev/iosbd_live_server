@extends('FrontEnd.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 page-header">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 fw-bold">Terms & Conditions</h2>
                    <!--<h5 class="display-6 fw-semibold">Happy Shopping</h5>-->
                    <!--<div class="d-flex justify-content-center mt-3">-->
                    <!--    <p class="m-0"><a href="{{route('home')}}">Home</a></p>-->
                    <!--    <p class="m-0 px-2">-</p>-->
                    <!--    <p class="m-0">Terms & Conditions</p>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container pb-5 mt-50">
        <div class="row">
            <div class="col-lg-11 mb-40 mx-auto">
                <div class="card py-4 px-3 shadow-sm">
                    <div class="card-body">
                        <p class="">
                            @if(session()->get('language') == 'bangla')
                                {!! nl2br($page->terms_bn) !!}
                            @else
                                {!! nl2br($page->terms) !!}
                            @endif
                        </p>
{{--                        <p><a href="{{route('order.return')}}">For Returning Any Order Click Here</a></p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

