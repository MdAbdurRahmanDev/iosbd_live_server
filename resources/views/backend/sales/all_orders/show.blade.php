@extends('admin.admin_master')
@section('admin')

    <style type="text/css">
        table, tbody, tfoot, thead, tr, th, td{
            border: 1px solid #dee2e6 !important;
        }
        th{
            font-weight: bolder !important;
        }
        .icon{
            background-color: #365486 !important;
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Order detail</h2>
                <p>Details for Order ID: {{ $order->invoice_no?? ''}}</p>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 mb-lg-0 mb-15">
                        <span class="text-white"> <i class="material-icons md-calendar_today"></i> <b>{{ $order->created_at?? ''}}</b> </span> <br />
                        <small class="text-white">Order ID: {{ $order->invoice_no?? ''}}</small>
                    </div>
                    @php
                        $payment_status = $order->payment_status;
                        $delivery_status = $order->delivery_status;
                    @endphp
                    <div class="col-lg-8 col-md-8 ms-auto text-md-end">
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200 bg-white"  id="update_payment_status">
                            <option value="0" @if ($payment_status == '0') selected @endif>Unpaid</option>
                            <option value="1" @if ($payment_status == '1') selected @endif>Paid</option>
                        </select>
                        @if($delivery_status != 'cancelled')
                            {{-- <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" style="background-color: white" id="update_delivery_status">
                                <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                                <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                <option value="on_the_way" @if ($delivery_status =='on_the_way') selected @endif>On The Way</option>
                                <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                <option value="cancelled" @if ($delivery_status == 'cancel_requested') selected @endif>Cancel Requested</option>
                            </select> --}}
                            <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" style="background-color: white" 
                            @if(Auth::guard('admin')->user()->role == 1 || in_array('19', json_decode(Auth::guard('admin')->user()->staff->role->permissions))) id="update_delivery_status" @endif>
                                <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                <option value="processing" @if ($delivery_status == 'processing') selected @endif>Processing</option>
                                <option value="waiting" @if ($delivery_status == 'waiting') selected @endif>Waiting</option>
                                <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                                <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                            </select>
                        @else
                            <input type="text" class="form-control d-inline-block mb-lg-0 mr-5 mw-200" value="{{ $delivery_status }}" disabled>
                        @endif

                        <!-- <a class="btn btn-primary" href="#">Save</a> -->
{{--                        <a class="btn btn-secondary print ms-2" href="#" onclick="window.print();" style="background-color: transparent"><i class="icon material-icons md-print"></i></a>--}}
                        <a class="btn btn-secondary print ms-2" href="{{ route('invoice.download', $order->id) }}"  style="font-size: 18px; background-color: transparent"><i class="fa fa-file"></i></a>
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body" >
                <form action="{{ route('admin.orders.update',$order->id) }}"  method="post">
                    @csrf
                <div class="row mb-50 mt-20 order-info-wrap" >
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>

                            <div class="text">
                                <h6 class="mb-1">Customer</h6>
                                <p class="mb-1">
                                    {{ $order->name ?? ''}} <br />
                                    {{ $order->email ?? ''}} <br />
                                    {{ $order->phone ?? ''}}
                                </p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{ $order->id }}">Edit Customer</a>
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                            <div class="text">
                                <h6 class="mb-1">Order info</h6>
                                <p class="mb-1">
                                    Order Id: {{ $order->invoice_no?? ''}} </br>
                                    Shipping: {{$order->shipping_name ?? ''}} <br />
                                    Pay method: @if($order->payment_method == 'cod') Cash On Delivery @else {{ $order->payment_method }} @endif <br />
                                    Status: @php
                                        $status = $order->delivery_status;
                                        if($order->delivery_status == 'cancelled') {
                                            $status = 'Cancelled';
                                        }

                                    @endphp
                                    {!! $status !!}
                                </p>
                                {{-- <a href="#">Download info</a> --}}
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                            <div class="text">
                                <h6 class="mb-1">Deliver to</h6>
                                <p class="mb-1">
                                    {{ $order->address }}
                                    <br>
                                    City: {{ ucwords($order->upazilla->name_en ?? 'Null' ) }}, <br />{{ ucwords($order->district->district_name_en ?? 'Null') }},<br />
                                    {{ ucwords($order->division->division_name_en ?? 'Null') }}
                                </p>
                                <!-- <a  href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->id }}">Edit Address</a> -->


                            </div>
                        </article>
                    </div>

                    <!-- col// -->
                    <!-- <div class="col-md-12 mt-40">
                        @php
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://bdcourier.com/api/courier-check?phone='.$order->phone,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: Bearer ' . 'wirEb949LPvJ4q9ojf3NZdJ2xN3nENtwlQG4rr20hnhchocIuCclnvdqBPR6'
                            ),
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
                            //echo $response;    // Response from the API

                            $data = json_decode($response, true); // Convert JSON to PHP array
                        @endphp

                        @if(isset($data['status']) && $data['status'] === 'success')
                            <div class="container mt-5 table-responsive-md">
                                <h2 class="mb-3">কুরিয়ার হিস্টোরি ({{ $order->phone }})</h2>
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>কুরিয়ার</th>
                                            <th>মোট</th>
                                            <th>সফল</th>
                                            <th>বাতিল</th>
                                            <th>সাফল্যের অনুপাত (%)</th>
                                            <th>বাতিলের অনুপাত (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalParcel = 0;
                                            $totalSuccess = 0;
                                            $totalCancelled = 0;
                                        @endphp

                                        @foreach($data['courierData'] as $courier => $info)
                                            @if($courier !== 'summary') 
                                                <tr>
                                                    <td>{{ ucfirst($courier) }}</td>
                                                    <td>{{ $info['total_parcel'] }}</td>
                                                    <td>{{ $info['success_parcel'] }}</td>
                                                    <td>{{ $info['cancelled_parcel'] }}</td>
                                                    <td>{{ number_format($info['success_ratio'], 2) }}%</td>
                                                    <td>
                                                        @php
                                                            $cancelRatio = $info['total_parcel'] > 0 ? ($info['cancelled_parcel'] / $info['total_parcel']) * 100 : 0;
                                                        @endphp
                                                        {{ number_format($cancelRatio, 2) }}%
                                                    </td>
                                                </tr>

                                                @php
                                                    $totalParcel += $info['total_parcel'];
                                                    $totalSuccess += $info['success_parcel'];
                                                    $totalCancelled += $info['cancelled_parcel'];
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot class="font-weight-bold">
                                        <tr>
                                            <td>মোট</td>
                                            <td>{{ $totalParcel }}</td>
                                            <td>{{ $totalSuccess }}</td>
                                            <td>{{ $totalCancelled }}</td>
                                            <td>{{ $totalParcel > 0 ? number_format(($totalSuccess / $totalParcel) * 100, 2) : 0 }}%</td>
                                            <td>{{ $totalParcel > 0 ? number_format(($totalCancelled / $totalParcel) * 100, 2) : 0 }}%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        @endif
                    </div> -->
                    
                    <div class="col-md-12 mt-40">
                        <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <th>Invoice</th>
                                    <td>{{ $order->invoice_no?? 'Null'}}</td>
                                    <th>Email</th>
                                    <td><input type="" class="form-control" name="email" value="{{ $order->email ?? 'Null'}}"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Shipping Address</th>
                                    <td>
                                        <label for="division_id" class="fw-bold text-black">Division <span class="text-danger">*</span></label>
                                        <select class="form-control select-active"  name="division_id" id="division_id" required>
                                            <option value="">Select Division</option>

                                            @foreach(get_divisions($order->division_id) as $division)
                                                <option value="{{ $division->id }}" {{ $division->id == $order->division_id ? 'selected': '' }}>{{ ucwords($division->division_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="district_id" class="fw-bold text-black">District <span class="text-danger">*</span></label>
                                        <select class="form-control select-active" name="district_id" id="district_id" required>
                                            <option selected=""  value="">Select District</option>
                                            @foreach(get_district_by_division_id($order->division_id) as $district)
                                                <option value="{{ $district->id }}" {{ $district->id == $order->district_id ? 'selected': '' }}>{{ ucwords($district->district_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="upazilla_id" class="fw-bold text-black">Upazilla <span class="text-danger">*</span></label>
                                        <select class="form-control select-active" name="upazilla_id" id="upazilla_id" required>
                                            <option selected=""  value="">Select Upazilla</option>
                                            @foreach(get_upazilla_by_district_id($order->district_id) as $upazilla)
                                                <option value="{{ $upazilla->id }}" {{ $upazilla->id == $order->upazilla_id ? 'selected': '' }}>{{ ucwords($upazilla->name_en) }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <select class="form-control select-active" name="payment_method" id="payment_method" required>
                                            <option selected=""  value="" >Select Payment Method</option>
                                            <option value="cod" @if($order->payment_method == 'cod') selected @endif>Cash</option>
                                            <option value="bkash" @if($order->payment_method == 'bkash') selected @endif>bKash</option>
                                            <option value="nagad" @if($order->payment_method == 'nagad') selected @endif>Nagad</option>
                                        </select>
                                    </td>
                                    <th>Shipping Charge</th>
                                    <td><input type="" class="form-control" id="cartSubTotalShi" name="shipping_charge" value="{{ $order->shipping_charge}}"></td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td><input type="" class="form-control" name="discount" value="{{ $order->discount }}"></td>

                                    <th>Payment Status</th>
                                    <td>
                                        @php
                                            $status = $order->payment_status;
                                            if($order->payment_status == '1') {
                                                $status = '<span class="badge rounded-pill alert-success text-success">Paid</span>';
                                            }
                                            else{
                                                $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
                                            }
                                        @endphp
                                        {!! $status !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Date</th>
                                    <td>{{ date_format($order->created_at,"Y/m/d")}}</td>
                                    @if($delivery_status == 'shipped' || $delivery_status == 'delivered')
                                        <th>Shipping Method</th>
                                        <td>{{ $order->shipping_company_name }}</td>
                                    @endif
                                </tr>
                                @if($delivery_status == 'shipped' || $delivery_status == 'delivered')
                                    @if($order->shipping_instructions)
                                        <tr>
                                            <th>Shipping Instructions</th>
                                            <td colspan="2">{{ $order->shipping_instructions }}</td>
                                        </tr>
                                    @endif 
                                    @if($order->shipping_comments)
                                        <tr>
                                            <th>Shipping Comments</th>
                                            <td colspan="2">{{ $order->shipping_comments }}</td>
                                        </tr>
                                    @endif 
                                @endif
                                <tr>
                                    <th>Sub Total</th>
                                    <td>{{ $order->sub_total }} <strong>Tk</strong></td>

                                    <th>Total</th>
                                    <td>{{ $order->grand_total }} <strong>Tk</strong></td>
                                    <!--  <td>

                                         <span class="badge badge-success">Delivered</span>

                                     </td> -->
                                </tr>
                                <tr>
                                    <th>Additional Comment</th>
                                    <td colspan="3">{{ $order->comment }}</td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <!-- col// -->
                </div>
                <!-- row // -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="15%">Product Code</th>
                                    <th width="15%">Unit Price</th>
                                    <th width="10%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($order->order_details as $key => $orderDetail)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    <img src="{{ asset($orderDetail->product->product_thumbnail ?? ' ') }}" width="40" height="40" class="img-xs" alt="Item" />
                                                </div>
                                                <div class="info">
                                                    <span class="text-bold">
                                                        {{$orderDetail->product->name_en ?? ' '}}
                                                    </span>

                                                    @if($orderDetail->is_varient && count(json_decode($orderDetail->variation))>0)
                                                        @foreach(json_decode($orderDetail->variation) as $varient)
                                                            <br/><span>{{ $varient->attribute_name }} : {{ $varient->attribute_value }}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ $orderDetail->product->product_code ?? 'N/A' }}</td>
                                        <td>{{ $orderDetail->price ?? '0.00' }}</td>
                                        <td>{{ $orderDetail->qty ?? '0' }}</td>
                                        <td class="text-end">{{ $orderDetail->price*$orderDetail->qty ?? '0.00' }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Subtotal:</dt>
                                                <dd>{{ $order->sub_total ?? '0.00' }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Shipping cost:</dt>
                                                <dd>{{ $order->shipping_charge }}</dd>
                                            </dl>
                                            @if($order->coupon)
                                                <dl class="dlist">
                                                    <dt>Applied Coupon:</dt>
                                                    <dd><b class=""><i>{{ $order->coupon }}</i></b></dd>
                                                </dl>
                                            @endif
                                            <dl class="dlist">
                                                <dt>Discount:</dt>
                                                <dd><b class="">{{ $order->discount }}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd><b class="h5">{{ $order->grand_total }}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">Status:</dt>
                                                <dd>
                                                    @php
            			                                $status = $order->delivery_status;
            			                                if($order->delivery_status == 'cancelled') {
            			                                    $status = '<span class="badge rounded-pill alert-danger">Cancelled</span>';
            			                                }else if($order->delivery_status == 'delivered') {
            			                                    $status = '<span class="badge rounded-pill alert-success">Delivered</span>';
            			                                }

            			                            @endphp
            			                            {!! $status !!}
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive// -->
                    </div>
                    <!-- col// -->
                    <div class="col-lg-1"></div>
                    {{-- <div class="col-lg-4">
                        <div class="box shadow-sm bg-light">
                            <h6 class="mb-15">Payment info</h6>
                            <p>
                                <img src="{{ asset('backend/assets/imgs/card-brands/2.png ') }}" class="border" height="20" /> Master Card ** ** 4768 <br />
                                Business name: Grand Market LLC <br />
                                Phone:
                            </p>
                        </div>
                        <div class="h-25 pt-4">
                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                    <!-- col// -->

                </div>
                </form>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->

        @if($delivery_status != 'shipped' && $delivery_status != 'delivered' && $delivery_status !='cancelled')
            <div class="card d-none">
                <div class="card-body">
                    <div class="col-md-12 mt-5 mb-5">
                        <h2>Ship Order</h2>
                        <form action="{{ route('admin.order.ship', $order->id) }}" method="post">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label class="form-label">Select Shipping Method</label>
                                    <select class="form-select" name="shipping_company_name" id="shipping_company_name" required>
                                        <option value="">--Select--</option>
                                        <option value="pathao">Pathao</option>
                                        <option value="steadfast">SteadFast</option>
                                        <option value="redx">RedX</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 d-none" id="shipping_name_div">
                                <label class="form-label">Shipping Method Name</label>
                                <div class="col-6">
                                    <input class="form-control" name="shipping_company_name_text" id="shipping_company_name_text" placeholder="Enter Shipping Method Name">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="form-label">Total Weight (gm)</label>
                                <div class="col-6">
                                    <input class="form-control" name="total_weight" id="total_weight" placeholder="Enter Parcel Total Weight" required>
                                </div>
                            </div>

                            <!-- RedX Fields Start -->
                            <div class="row mt-3 d-none redx_component">
                                <label class="form-label">Delivery Area</label>
                                <div class="col-6">
                                    <select class="form-select redx_input" name="redx_delivery_area" id="redx_delivery_area">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 d-none redx_component">
                                <label class="form-label">Pickup Store</label>
                                <div class="col-6">
                                    <select class="form-select redx_input" name="redx_pickup_store" id="redx_pickup_store">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>
                            <!-- RedX Fields End -->

                            <!-- Pathao Fields Start -->
                            <div class="row mt-3 d-none pathao_component">
                                <label class="form-label">Delivery City</label>
                                <div class="col-6">
                                    <select class="form-select pathao_input" name="pathao_city_id" id="pathao_city_id">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 d-none pathao_component">
                                <label class="form-label">Delivery Zone</label>
                                <div class="col-6">
                                    <select class="form-select pathao_input" name="pathao_zone_id" id="pathao_zone_id">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 d-none pathao_component">
                                <label class="form-label">Delivery Area</label>
                                <div class="col-6">
                                    <select class="form-select pathao_input" name="pathao_area_id" id="pathao_area_id">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 d-none pathao_component">
                                <label class="form-label">Pickup Store</label>
                                <div class="col-6">
                                    <select class="form-select pathao_input" name="pathao_store_id" id="pathao_store_id">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Pathao Fields End -->

                            <div class="row mt-3">
                                <label class="form-label">Shipping Instructions</label>
                                <div class="col-6">
                                    <textarea class="form-control" name="shipping_instructions" id="shipping_instructions" placeholder="Enter Shipping Instruction"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="form-label">Comments</label>
                                <div class="col-6">
                                    <textarea class="form-control" name="shipping_comments" id="shipping_comments" placeholder="Enter Shipping Comments"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary">Ship Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
@push('footer-script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="shipping_id"]').on('change', function(){
                var shipping_cost = $(this).val();
                if(shipping_cost) {
                    $.ajax({
                        url: "{{  url('/checkout/shipping/ajax') }}/"+shipping_cost,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            //console.log(data);
                            $('#ship_amount').text(data.shipping_charge);

                            let shipping_price = parseInt(data.shipping_charge);
                            let grand_total_price = parseInt($('#cartSubTotalShi').val());
                            grand_total_price += shipping_price;
                            $('#grand_total_set').html(grand_total_price);
                            $('#total_amount').val(grand_total_price);
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

        /* ============ Update Payment Status =========== */
        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){

                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                location.reload();
                // End Message
            });
        });

        /* ============ Update Delivery Status =========== */
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {
                _token:'{{ @csrf_token() }}',
                order_id:order_id,
                status:status
            }, function(data){
                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                location.reload();
                // End Message
            });
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--  Division To District Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function(){
                var division_id = $(this).val();
                // const divArray = division.split("-");
                // var division_id = divArray[0];
                // $('#division_name').val(divArray[1]);
                if(division_id) {
                    $.ajax({
                        url: "{{  url('/division-district/ajax') }}/"+division_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                            $.each(data, function(key, value){
                                // console.log(value);
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                            });
                            $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });
    </script>

    <!--  District To Upazilla Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                // const divArray = district.split("-");
                // var division_id = divArray[0];
                // $('#district_name').val(divArray[1]);
                if(district_id) {
                    $.ajax({
                        url: "{{  url('/district-upazilla/ajax') }}/"+district_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="upazilla_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                                $('select[name="upazilla_id"]').append('<option  class="d-none" value="'+ value.id +'">' + value.name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#shipping_company_name").on("change", function () {

                $("#shipping_name_div").addClass("d-none");
                $("#shipping_company_name_text").prop("required", false);

                $(".redx_component").addClass("d-none");
                $(".redx_input").prop("required", false);

                $(".pathao_component").addClass("d-none");
                $(".pathao_input").prop("required", false);

                if ($(this).val() === "other") {
                    $("#shipping_name_div").removeClass("d-none");
                    $("#shipping_company_name_text").prop("required", true);
                }else if ($(this).val() === "redx"){
                    $(".redx_component").removeClass("d-none");
                    $(".redx_input").prop("required", true);
                }else if ($(this).val() === "pathao"){
                    $(".pathao_component").removeClass("d-none");
                    $(".pathao_input").prop("required", true);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{ route('redx.getAreas') }}",
                type: "GET",
                success: function (response) {
                    if (response.status == 'success' && response.data.areas) {
                        $.each(response.data.areas, function (index, area) {
                            $('#redx_delivery_area').append(
                                `<option value="${area.id}@#@${area.name}">${area.name}, ${area.division_name}-${area.post_code}</option>`
                            );
                        });
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching areas:", xhr.responseText);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{ route('redx.getPickupStores') }}",
                type: "GET",
                success: function (response) {
                    if (response.status == 'success' && response.data.pickup_stores) {
                        $.each(response.data.pickup_stores, function (index, store) {
                            $('#redx_pickup_store').append(
                                `<option value="${store.id}">${store.name}, ${store.area_name}</option>`
                            );
                        });
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching areas:", xhr.responseText);
                }
            });
        });
    </script>

    <!-- Pathao Start -->
    <script>
        $(document).ready(function() {
            fetchStores();

            function fetchStores() {
                $.ajax({
                    url: "{{ route('pathao.getPickupStores') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        let storeDropdown = $('#pathao_store_id');
                        storeDropdown.empty();
                        storeDropdown.append('<option value="">--Select--</option>');

                        $.each(response, function(index, store) {
                            storeDropdown.append(`<option value="${store.store_id}">${store.store_name}</option>`);
                        });

                    },
                    error: function(xhr) {
                        console.error("Error fetching stores:", xhr.responseText);
                    }
                });
            }

            fetchCities();

            function fetchCities() {
                $.ajax({
                    url: "{{ route('pathao.getCities') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        let cityDropdown = $('#pathao_city_id');
                        cityDropdown.empty();
                        cityDropdown.append('<option value="">--Select--</option>');

                        $.each(response, function(index, city) {
                            cityDropdown.append(`<option value="${city.city_id}">${city.city_name}</option>`);
                        });

                    },
                    error: function(xhr) {
                        console.error("Error fetching cities:", xhr.responseText);
                    }
                });
            }

            $('#pathao_city_id').change(function() {
                let cityId = $(this).val();
                let zoneDropdown = $('#pathao_zone_id');
                zoneDropdown.empty().append('<option id="loading-option" value="">Loading...</option>');

                if (cityId) {
                    $.ajax({
                        url: "{{ url('pathao/get-zones') }}/" + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            zoneDropdown.empty().append('<option value="">--Select--</option>');
                            $.each(response, function(index, zone) {
                                zoneDropdown.append(`<option value="${zone.zone_id}">${zone.zone_name}</option>`);
                            });
                        },
                        error: function(xhr) {
                            console.error("Error fetching zones:", xhr.responseText);
                        }
                    });
                }
            });

            $('#pathao_zone_id').change(function() {
                let zoneId = $(this).val();
                let areaDropdown = $('#pathao_area_id');
                areaDropdown.empty().append('<option id="loading-option" value="">Loading...</option>');

                if (zoneId) {
                    $.ajax({
                        url: "{{ url('pathao/get-areas') }}/" + zoneId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            areaDropdown.empty().append('<option value="">--Select--</option>');
                            $.each(response, function(index, area) {
                                areaDropdown.append(`<option value="${area.area_id}">${area.area_name}</option>`);
                            });
                        },
                        error: function(xhr) {
                            console.error("Error fetching areas:", xhr.responseText);
                        }
                    });
                }
            });
            
        });
    </script>
    <!-- Pathao End -->

    <!-- Customer Edit Modal -->
    <div class="modal fade" id="staticBackdrop1{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.user.update',$order->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter the name" value="{{ $order->name ?? 'Null'}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter the email" value="{{ $order->email ?? 'Null'}}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter the phone" value="{{ $order->phone ?? 'Null'}}">
                            </div>
                            <!-- <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Password</label>
                                <input type="password" class="form-control">
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
