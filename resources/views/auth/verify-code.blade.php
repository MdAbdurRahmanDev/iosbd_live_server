@extends('FrontEnd.master')
@section('content')
@section('title')
Code Verify
@endsection

<style>
    .eye-icon {
        right: 15px;
        transform: translateY(-220%);
    }

        .otp-input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            margin: 0 5px;
        }
        .otp-input:focus {
            border-color: #6f42c1;
            outline: none;
        }

</style>
      <div class="container-fluid py-5 page-header d-none">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 fw-bold">{{get_setting('business_name')->value}}</h2>
                    <h5 class="display-6 fw-semibold">Happy Shopping</h5>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Sign In</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Sign In Start -->
    <div class="container d-flex justify-content-center" style="margin-top: 6rem; margin-bottom: 6rem">
        <div class="row">
            <div class="card p-4 text-center shadow-lg" style="width: 350px; border-radius: 12px;">
                <h3 class="fw-bold text-dark">Enter Your Code</h3>
                <p class="text-muted">Please enter the 4-digit code sent to your mobile</p>

                <form method="POST" action="{{ route('verify.code.post') }}">
                    @csrf
                    <div class="d-flex justify-content-center my-3">
                        <input type="text" class="otp-input" name="otp[]" maxlength="1" required>
                        <input type="text" class="otp-input" name="otp[]" maxlength="1" required>
                        <input type="text" class="otp-input" name="otp[]" maxlength="1" required>
                        <input type="text" class="otp-input" name="otp[]" maxlength="1" required>
                    </div>

                    @error('otp')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <p class="text-muted">
                        Enter the code within <span id="countdown">1:00</span>.
                    </p>

                    <button type="button" id="resend-btn" action="{{ route('resend.code') }}" class="btn btn-link text-primary fw-bold" disabled>
                        Resend Code
                    </button>

                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">Verify</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        let countdownElement = $("#countdown");
        let resendButton = $("#resend-btn");
        let otpInputs = $(".otp-input");

        let maxTime = 60;
        let currentTime = Math.floor(Date.now() / 1000);

        let storedTime = sessionStorage.getItem("otp_timer");
        let lastUpdated = sessionStorage.getItem("otp_last_updated");

        let elapsedTime = lastUpdated ? currentTime - parseInt(lastUpdated) : 0;
        let timer = storedTime ? Math.max(0, parseInt(storedTime) - elapsedTime) : maxTime;

        if (isNaN(timer) || timer <= 0) {
            timer = maxTime;
            sessionStorage.setItem("otp_timer", maxTime);
            sessionStorage.setItem("otp_last_updated", currentTime);
            resendButton.prop("disabled", false);
        } else {
            resendButton.prop("disabled", true);
        }

        let interval;

        function startCountdown() {
            clearInterval(interval);
            interval = setInterval(function () {
                if (timer <= 0) {
                    clearInterval(interval);
                    countdownElement.text("Time Over!");
                    resendButton.prop("disabled", false);
                    otpInputs.prop("disabled", true);
                    return;
                }
                if (timer > 0) {
                    resendButton.prop("disabled", true);
                } else {
                    resendButton.prop("disabled", false);
                }

                let minutes = Math.floor(timer / 60);
                let seconds = timer % 60;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                countdownElement.text(minutes + ":" + seconds);

                timer--;
                sessionStorage.setItem("otp_timer", timer);
                sessionStorage.setItem("otp_last_updated", Math.floor(Date.now() / 1000));
            }, 1000);
        }

        startCountdown();

        resendButton.on("click", function (e) {
            e.preventDefault();

            $.ajax({
                url: resendButton.attr("action"),
                method: "POST",
                data: { _token: "{{ csrf_token() }}" },
                success: function (response) {
                    console.log("OTP Sent, Timer Restarting...");

                    let newStartTime = Math.floor(Date.now() / 1000);
                    timer = maxTime;
                    sessionStorage.setItem("otp_timer", maxTime);
                    sessionStorage.setItem("otp_last_updated", newStartTime);

                    otpInputs.prop("disabled", false);
                    resendButton.prop("disabled", true);

                    clearInterval(interval);
                    startCountdown();

                    toastr.success("New OTP has been sent successfully!");
                }
            });
        });

        otpInputs.on("input", function () {
            let $this = $(this);
            if ($this.val().length === 1) {
                $this.next(".otp-input").focus();
            }
        });

        otpInputs.on("keydown", function (e) {
            if (e.key === "Backspace" && $(this).val() === "") {
                $(this).prev(".otp-input").focus();
            }
        });

        if (timer <= 0) {
            //otpInputs.prop("disabled", true);
            //resendButton.prop("disabled", false);
        }
    });
</script>
@endpush

