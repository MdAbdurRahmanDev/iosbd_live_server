@extends('FrontEnd.master')
@section('content')
@section('title')
Forget Password
@endsection

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 2rem;">
    <div class="row w-100">
        <div class="col-12 col-md-6 mx-auto"> 
            <div class="card p-5 text-center shadow-lg mx-auto" style="border-radius: 15px; max-width: 500px;">
                <h3 class="fw-bold text-dark">Forget Password</h3>
                <p class="text-muted">Enter your registered mobile number to receive a new password</p>

                @if(session('message'))
                    <div class="alert alert-{{ session('alert-type') }}" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form class="mt-4" method="POST" action="{{ route('send.password') }}">
                    @csrf
                    <div class="mb-4">
                        <input type="number" class="form-control text-center fw-bold py-2"
                               name="mobile_number" placeholder="Enter Your Mobile Number" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold">Send Password</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
