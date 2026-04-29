@extends('FrontEnd.master')
@section('title')
    Checkout
@endsection
@section('content')
@push('css')


<style>
    .select2-container {
        width: 100% !important;
    }
    .select2-container .select2-selection--single {
        height: 50px !important;
        border: 1px solid #ced4da !important;
        border-radius: 0px !important;
        padding: 8px 12px !important;
        text-align: left !important;
    }


    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px !important;
    }
    .select2-container .select2-selection--single:hover {
        border-color: black !important;
    }
    .input-group{
        padding-left: 0px;
    }
</style>
@endpush
<!-- Header Start -->
<div class="container-fluid py-2 page-header">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="fw-bold">Checkout</h2>
                <!--<h5 class="display-6 fw-semibold">Happy Shopping</h5>-->
                <!--<div class="d-flex justify-content-center mt-3">-->
                <!--    <p class="m-0"><a href="{{route('home')}}">Home</a></p>-->
                <!--    <p class="m-0 px-2">-</p>-->
                <!--    <p class="m-0">Checkout</p>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Check Out Information Start -->
<section class="container mb-5 pt-0">
    {{-- <div class="row">
        <div class="mb-40">
            <h1 class="heading-2 mb-10">Checkout</h1>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are <span class="text-brand" id="total_cart_qty"></span> products in your cart</h6>
            </div>
        </div>
    </div> --}}
    <div class="">
        <div class="row px-xl-5">
            <div class="col-lg-8 px-5 pb-5 pt-0 bg-white">

                <form action="{{ route('checkout.payment') }}" method="post">
                    @csrf
                <div class="mb-4">
                    <h4 class="fw-semibold mb-4">Billing Address</h4>
                    <div class="row g-3">
                        <div class="col-md-12 form-group">
                            <label>Full Name</label><span class="text-danger">*</span>
                            <input class="form-control" type="text" required="" id="name" name="name" placeholder="Full Name" value="{{ Auth::user()->name ?? old('name') }}">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        {{-- <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Dewal">
                        </div> --}}
                        <div class="col-md-6 form-group">
                            <label>E-mail</label><span class="text-danger">*</span>
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email address" value="{{ Auth::user()->email ?? old('email') }}" required>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Mobile No</label><span class="text-danger">*</span>
                            <input class="form-control" required type="number" name="phone" placeholder="Phone no" id="phone" value="{{ Auth::user()->phone ?? old('phone') }}">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Full Address</label><span class="text-danger">*</span>
                            <textarea style="height: 100px !important" name="address" id="address" class="form-control " placeholder="Full address" required>{{ old('address', auth()->user()->address ?? '') }}</textarea>
                            @error('address')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        {{-- <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="form-control">
                                <option selected>United States</option>
                                <option>Bangladesh</option>
                                <option>India</option>
                                <option>Nepal</option>
                                <option>Pakistan</option>
                                <option>Sri-lanka</option>
                                <option>Nowkhali</option>
                            </select>
                        </div> --}}
                        {{-- <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Devision</label><span class="text-danger">*</span>
                                <select class="form-control select2" name="division_id" id="division_id"  required>
                                    <option value="">Select Division</option>
                                    @foreach(get_divisions() as $division)
                                        <option value="{{ $division->id }}">{{ ucwords($division->division_name_en) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>District</label><span class="text-danger">*</span>
                                <select class="form-control select2" name="district_id" id="district_id" required>
                                    <option selected="" value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Upazila</label><span class="text-danger">*</span>
                                <select class="form-control select2" name="upazilla_id" id="upazilla_id" required>
                                    <option selected="" value="">Select Upazilla</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group d-none">
                            <label>Product Shipping</label><span class="text-danger">*</span>
                            <select class="form-control select2" name="shipping_id" id="shipping_id" required>
                                @foreach ($shippings as $key => $shipping)
                                    <option value="{{ $shipping->id }}">{{ $shipping->name }}
                                        (@if($shipping->type == 1) Inside Dhaka @else Outside Dhaka @endif) - ৳{{ $shipping->shipping_charge }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Additional Information</label>
                            <textarea style="height: 100px !important" name="comment" class="form-control" id="comment" placeholder="Comment" rows="5">{{old('comment')}}</textarea>
                            @error('address')
                                <p class="text-danger">{{$message}}</p>
                            @enderror                        </div>
                        <div class="col-md-12 form-group d-none">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" data-bs-toggle="collapse"
                                    data-bs-target="#shipping-address">
                                <label class="custom-control-label" for="shipto" data-bs-toggle="collapse"
                                    data-bs-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                        @guest
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="" name="create_account">
                                <label class="custom-control-label" for="shipto" style="margin-top: 7px; margin-left: 7px">Want to create account</label>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="Sunny">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Dewal">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+88 01700 000000">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" placeholder="Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="form-control">
                                <option selected>United States</option>
                                <option>Bangladesh</option>
                                <option>India</option>
                                <option>Nepal</option>
                                <option>Pakistan</option>
                                <option>Sri-lanka</option>
                                <option>Nowkhali</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mb-4">
                    <div class="input-group input-group-sm">
                        <input type="text" id="coupon" name="coupon" class="form-control form-control-sm" placeholder="Enter Coupon Code">
                        <button type="button" class="btn btn-dark btn-sm" id="applyCoupon" style="padding: 8px 15px !important">Apply Coupon</button>
                    </div>
                    <small id="couponError" class="text-danger mt-1 d-none"></small>
                </div>

                <div class="card mb-3">
                    <div class="card-header text-dark">
                        <h4 class="fw-semibold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3 d-flex justify-content-between align-items-center">
                            Products
                        </h5>
                        @php
                            $total_discount = 0;
                        @endphp
                        
                        @foreach ($carts as $cart)
                            <div class="d-flex justify-content-between mb-1 cart-item" data-id="{{$cart->rowId}}">
                                <p>{{$cart->name}}</p>
                                <p> x {{$cart->qty}}</p>
                                <p>৳{{round($cart->subtotal)}}</p>
                                <span class="text-danger delete-cart-item" style="cursor: pointer; margin-left: 10px" data-id="{{$cart->rowId}}">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </div>
                            @php
                                $total_discount += $cart->options->discount*$cart->qty;
                            @endphp
                            
                        @endforeach
                        
                         @php
                            $total_discount = round($total_discount);
                        @endphp
                        
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">৳<span id="cartSubTotal">{{ $cartTotal }}</span></h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium">৳<span id="discount">{{ $total_discount ?? 0 }}</span></h6>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">৳<span id="ship_amount">0.00</span></h6>
                            <input type="hidden" value="" name="shipping_charge" class="ship_amount" />
                            <input type="hidden" value="" name="shipping_type" class="shipping_type" />
                            <input type="hidden" value="" name="shipping_name" class="shipping_name" />
                        </div>
                        
                        <input type="hidden" name="coupon_code" value="">
                        <div id="couponInformation" style="margin-top: 13px;">
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between my-2">
                            <input type="hidden" value="{{ $cartTotal }}" name="sub_total" id="cartSubTotalShi" />
                            <input type="hidden" value="{{ $total_discount ?? 0 }}" id="prev_discount_value" />
                            <input type="hidden" value="{{ $total_discount ?? 0 }}" name="discount" id="discount_value" />
                            <input type="hidden" value="{{ round($cartTotal - $total_discount) }}" name="grand_total" id="grand_total" />
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">৳<span id="grand_total_set">{{ round($cartTotal - $total_discount) }}</span></h5>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="fw-semibold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input"name="payment_option" id="cash_on_delivery" value="cod" checked>
                                <label class="custom-control-label" for="paypal">Cash On Delivery</label>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment"
                                    id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment"
                                    id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark btn-lg d-block fw-semibold py-2 px-4">Place Order</button>
                </div>
            </div>
        </form>
        </div>

    </div>
</section>
@endsection
@push('js')
{{--<script>
    $(document).ready(function () {
        $("#applyCoupon").click(function () {
            var couponCode = $("#coupon").val().trim();
            var errorMsg = $("#couponError");

            errorMsg.addClass("d-none").text("");

            if (couponCode === "") {
                errorMsg.removeClass("d-none").text("Please enter a coupon code.");
                return;
            }

            $.ajax({
                url: "{{ route('apply-coupon') }}",
                type: "POST",
                data: {
                    apply_coupon: couponCode,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        alert("Coupon applied successfully!");
                    } else {
                        errorMsg.removeClass("d-none").text(response.message);
                    }
                },
                error: function (xhr) {
                    errorMsg.removeClass("d-none").text("Invalid coupon or server error.");
                }
            });
        });
    });
</script>--}}
<!--  Division To District Show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
    // Division Change Event
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        if(division_id) {
            $.ajax({
                url: 'division-district/ajax/',
                type: "GET",
                data: {'division_id': division_id},
                dataType: "json",
                success: function(data) {
                    // Reset district selection
                    $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                    // Populate district options
                    $.each(data, function(key, value){
                        $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                    });

                    // Reset Upazila selection
                    $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select Upazila</option>');

                    // Reset shipping selection when division changes
                    $('select[name="shipping_id"]').val('');
                },
            });
        } else {
            // Reset selections
            $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
            $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select Upazila</option>');
            $('select[name="shipping_id"]').val('');
        }
    });

    $('select[name="district_id"]').on('change', function(){
        var districtText = $('select[name="district_id"] option:selected').text().trim().toLowerCase();
        var shippingSelect = $('select[name="shipping_id"]');

        var insideDhaka = false;
        var outsideDhakaOption = null;

        shippingSelect.find('option').each(function() {
            var shippingText = $(this).text().trim().toLowerCase();

            if (districtText.includes("dhaka") && shippingText.includes("inside dhaka")) {
                shippingSelect.val($(this).val()).change();
                insideDhaka = true;
            }

            if (shippingText.includes("outside dhaka")) {
                outsideDhakaOption = $(this).val();
            }
        });

        if (!insideDhaka && outsideDhakaOption) {
            shippingSelect.val(outsideDhakaOption).change();
        }
    });


    // Function to capitalize first letter of a string
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Address Relationship Division/District/Upazilla Show Data Ajax
    $('select[name="address_id"]').on('change', function(){
        var address_id = $(this).val();
        $('.selected_address').removeClass('d-none');
        if(address_id) {
            $.ajax({
                url: "{{  url('/address/ajax') }}/"+address_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $('#dynamic_division').text(capitalizeFirstLetter(data.division_name_en));
                    $('#dynamic_division_input').val(data.division_id);
                    $("#dynamic_district").text(capitalizeFirstLetter(data.district_name_en));
                    $('#dynamic_district_input').val(data.district_id);
                    $("#dynamic_upazilla").text(capitalizeFirstLetter(data.upazilla_name_en));
                    $('#dynamic_upazilla_input').val(data.upazilla_id);
                    $("#dynamic_address").text(data.address);
                    $('#dynamic_address_input').val(data.address);
                },
            });
        } else {
            alert('danger');
        }
    });
});

</script>

<!--  District To Upazilla Show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: '/district-upazilla/ajax/',
                    type:"GET",
                    data:{'district_id': district_id},
                    dataType:"json",
                    success:function(data) {
                    var d =$('select[name="upazilla_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<!-- create address ajax -->
<script type="text/javascript">
$(document).ready(function() {
    $('#addressStore').on('click', function() {
        var division_id = $('#division_id').val();
        var district_id = $('#district_id').val();
        var upazilla_id = $('#upazilla_id').val();
        var address     = $('#address').val();
        var is_default  = $('#is_default').val();
        var status      = $('#status').val();

        $.ajax({
            url: '{{ route('address.ajax.store') }}',
            type: "POST",
            data: {
              _token: $("#csrf").val(),
              division_id: division_id,
              district_id: district_id,
              upazilla_id: upazilla_id,
              address: address,
              is_default: is_default,
              status: status,
            },
            dataType:'json',
            success: function(data){
                // console.log(data);
                $('#address').val(null);

                $('select[name="address_id"]').html('<option value="" selected="" disabled="">Select Address</option>');
                $.each(data, function(key, value){
                    $('select[name="address_id"]').append('<option value="'+ value.id +'">' + value.address + '</option>');
                });
                $('select[name="division_id"]').html('<option value="" selected="" disabled="">Select Division</option>');
                $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select Upazila</option>');

                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 2000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Swal.fire({
                        type: 'error',
                        title: data.error
                    })
                }

                // End Message
                $('#Close').click();
            }
        });
     });
});
</script>
<script>
    var couponApplied = false; // Declare couponApplied variable
    $(document).ready(function() {
        // Your existing AJAX code for applying the coupon
        $('form[action="{{ route('apply-coupon') }}"]').submit(function(event) {
            event.preventDefault();
            if (couponApplied) {
                const errorToast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    errorToast.fire({
                        title: 'Coupon Already Used'
                    });
                return;
            }
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.discount) {
                    let couponDiscount = parseInt(data.discount);

                    // Set coupon discount as an attribute for later use
                    $('#grand_total_set').attr('data-coupon-discount', couponDiscount);

                    // Set couponApplied to true after applying the coupon
                    couponApplied = true;

                    // Update the displayed coupon amount
                    $('#coupon_amount').text('৳' + couponDiscount);

                    // Update the total price after applying the coupon
                    updateTotalPrice();
                    showCouponInformation(data);
                }
                    const successToast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Create error Toast mixin
                    const errorToast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Check if there is an error or success message in the data
                    if ($.isEmptyObject(data.error)) {
                        // Display success Toast
                        successToast.fire({
                            title: data.success
                        });
                    } else {
                        // Display error Toast
                        errorToast.fire({
                            title: data.error
                        });
                    }

                    // End Message
                    $('#Close').click();
                    // Handle other messages or actions if needed
                },
                error: function(xhr, status, error) {
                    // Handle errors if necessary
                    const errorToast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });

                // Check if there is an error message in the response
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    // Display error Toast with the error message
                    errorToast.fire({
                        title: xhr.responseJSON.error
                    });
                } else {
                    // Display a generic error Toast
                    errorToast.fire({
                        title: 'Invalid Coupon Code'
                    });
                }
                            }
                        });
                    });
        function showCouponInformation(data) {
        // Assuming you have an element to display the coupon information
        // Update the element with the coupon details
        $('#couponInformation').html('<div class="d-flex justify-content-between">' +
            '<h6 class="font-weight-medium">Coupon</h6>' +
            '<h6 class="font-weight-medium">৳<span>' + data.discount + '</span></h6>' +
            '</div>' +
            '<input type="hidden" value="" name="shipping_charge" class="ship_amount" />' +
            '<input type="hidden" value="" name="shipping_type" class="shipping_type" />' +
            '<input type="hidden" value="" name="shipping_name" class="shipping_name" />');
    }

        // Your existing AJAX code for updating shipping information
        $('select[name="shipping_id"]').on('change', function() {
            var shipping_id = $(this).val();

            if (shipping_id) {
                $.ajax({
                    url: "{{ url('/checkout/shipping/ajax') }}/" + shipping_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ship_amount').text(data.shipping_charge);
                        $('.ship_amount').val(data.shipping_charge);
                        $('.shipping_name').val(data.name);
                        $('.shipping_type').val(data.type);

                        updateTotalPrice(); // Update the total price after selecting shipping
                    },
                });
            } else {
                // Reset the elements if no shipping option is selected
                $('#ship_amount').text('0');
                $('.ship_amount').val('0');
                $('.shipping_name').val('');
                $('.shipping_type').val('');

                updateTotalPrice(); // Update the total price after resetting shipping
            }
        });

        // Function to update the total price based on coupon and shipping
        function updateTotalPrice() {
            // let couponDiscount = couponApplied ? parseInt($('#grand_total_set').attr('data-coupon-discount')) : 0;
            let discount = parseInt($('#discount_value').val());
            let shipping_price = parseInt($('#ship_amount').text());
            let product_price = parseInt($('#cartSubTotalShi').val());
            let grand_total_price = product_price + shipping_price - discount;
            // Update the displayed total
            $('#grand_total_set').text(grand_total_price);
            $('#grand_total').val(grand_total_price);
        }
    });

</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#division_id').on('change', function() {
            let divisionId = $(this).val();
            if (divisionId) {
                $.ajax({
                    url: "{{ url('get-districts') }}/" + divisionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district_id').empty().append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district_id').append('<option value="'+ value.id +'">'+ value.district_name_en +'</option>');
                        });
                    }
                });
            } else {
                $('#district_id').empty().append('<option value="">Select District</option>');
            }
        });

        // Load upazilas based on selected district
        $('#district_id').on('change', function() {
            let districtId = $(this).val();
            let selectedText = $("#district_id option:selected").text().trim();

            if (districtId) {
                $.ajax({
                    url: "{{ url('get-upazilas') }}/" + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#upazilla_id').empty().append('<option value="">Select Upazilla</option>');
                        $.each(data, function(key, value) {
                            $('#upazilla_id').append('<option value="'+ value.id +'">'+ value.upazilla_name_en +'</option>');
                        });
                    }
                });
            } else {
                $('#upazilla_id').empty().append('<option value="">Select Upazilla</option>');
            }

            // auto-select Product Shipping
            let insideDhakaOption = $('#shipping_id option').filter(function() {
                return $(this).text().includes("Inside Dhaka");
            }).val();

            let outsideDhakaOption = $('#shipping_id option').filter(function() {
                return $(this).text().includes("Outside Dhaka");
            }).val();

            console.log("Inside Dhaka Option:", insideDhakaOption);
            console.log("Outside Dhaka Option:", outsideDhakaOption);

            if (selectedText === "Dhaka") {
                $('#shipping_id').val(insideDhakaOption).trigger('change');
            } else {
                $('#shipping_id').val(outsideDhakaOption).trigger('change');
            }
        });


    });
</script>
<script>
    $(document).on('click', '.delete-cart-item', function() {
        var cartRowId = $(this).data('id');
        var itemElement = $(this).closest('.cart-item');

        $.ajax({
            url: "/cart-destroy",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                rowId: cartRowId
            },
            success: function(response) {
                if (response.success) {
                    itemElement.remove();
                    toastr.success("Item removed successfully!");
                    setTimeout(function() {
                        location.reload();
                    }, 300);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                toastr.error("Error removing item. Please try again.");
            }
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#applyCoupon').click(function () {
            let couponCode = $('#coupon').val().trim(); // Get coupon code
            let cartTotal = parseFloat($('#cartSubTotal').text()); // Get cart total

            // If button text is "Remove Coupon", reset the fields
            if ($(this).text() === "Remove Coupon") {
                resetCoupon();
                return;
            }

            if (couponCode === '') {
                $('#couponError').text('Please enter a coupon code!').removeClass('d-none');
                return;
            } else {
                $('#couponError').addClass('d-none'); // Hide error if coupon is entered
            }

            $.ajax({
                url: "{{ route('apply-coupon') }}",  // Replace with your actual route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    apply_coupon: couponCode,
                    cart_value: cartTotal,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let discountAmount = response.discount.toFixed(2);
                        let grandTotal = cartTotal - response.discount + parseFloat($('#ship_amount').text());

                        // Update discount fields
                        $('#discount').text(discountAmount);
                        $('#discount_value').val(discountAmount);
                        $('input[name="coupon_code"]').val(couponCode);

                        // Update grand total
                        $('#grand_total_set').text(grandTotal.toFixed(2));
                        $('#grand_total').val(grandTotal.toFixed(2));

                        // Disable input field and change button text to "Remove Coupon"
                        $('#coupon').prop('disabled', true);
                        $('#applyCoupon').text('Remove Coupon').removeClass('btn-dark').addClass('btn-danger');

                        $('#couponInformation').html('<p class="text-success">Coupon applied successfully!</p>'); 
                    } else if (response.error) {
                        $('#couponError').text(response.error).removeClass('d-none'); // Show error message
                    }
                },
                error: function () {
                    $('#couponError').text('Something went wrong. Please try again.').removeClass('d-none');
                }
            });
        });

        function resetCoupon() {
            var prevDiscount = $('#prev_discount_value').val();
            $('#discount').text(prevDiscount); // Reset discount
            $('#discount_value').val(prevDiscount); // Clear hidden discount field
            $('input[name="coupon_code"]').val(""); // Clear coupon code

            let cartTotal = parseFloat($('#cartSubTotal').text());
            let grandTotal = cartTotal + parseFloat($('#ship_amount').text()) - prevDiscount;

            $('#grand_total_set').text(grandTotal.toFixed(2)); // Reset grand total
            $('#grand_total').val(grandTotal.toFixed(2));

            // Enable input field and change button text to "Apply Coupon"
            $('#coupon').prop('disabled', false).val('');
            $('#applyCoupon').text('Apply Coupon').removeClass('btn-danger').addClass('btn-dark');

            $('#couponInformation').html(''); // Clear coupon message
            $('#couponError').addClass('d-none'); // Hide error message
        }
    });
</script>



@endpush
