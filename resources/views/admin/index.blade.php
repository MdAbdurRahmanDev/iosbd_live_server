@extends('admin.admin_master')
@push('css')
<script type="text/javascript">
    window.onload = function () {

        var options = {
            exportEnabled: true,
            animationEnabled: true,
            title: {
                text: "{{ get_setting('site_name')->value ?? ''}}"
            },
            legend: {
                horizontalAlign: "right",
                verticalAlign: "center"
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "<b>{name}</b>: {y} (#percent)",
                indexLabel: "{name}",
                legendText: "{name} (#percent)",
                indexLabelPlacement: "inside",
                dataPoints: [{
                        y: 6,
                        name: "Pending"
                    },
                    {
                        y: 9,
                        name: "Prossecing"
                    },
                    {
                        y: 10,
                        name: "Delivery"
                    },
                    {
                        y: 12,
                        name: "Sales"
                    },
                    {
                        y: 5,
                        name: "Others"
                    },
                    {
                        y: 6,
                        name: "Utilities"
                    }
                ]
            }]
        };
        $("#chartContainer").CanvasJSChart(options);

    }

</script>
@endpush
@section('admin')
    @php
        $role = Auth::guard('admin')->user()->role
    @endphp
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>

        </div>
        <div>
            {{-- <a href="{{ route('pos.index') }}" class="btn btn-primary p-3"><i class="fab fa-product-hunt"></i></a> --}}
        </div>
    </div>
    <div class="row">
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow p-3 mb-5 bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="fa-solid fa-money-check-dollar"></i></span>
                    <div class="text">
                        <a href="{{ route('all_orders.index', ['delivery_status' => 'pending']) }}">
                            <h6 class="mb-1 card-title">Pending Orders</h6>
                            <span>{{ process_order('pending') }}</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @endif
        @if(Auth::guard('admin')->user()->role == '2')
            @php $vendor = \App\Models\Vendor::where('user_id', Auth::guard('admin')->user()->id)->first() @endphp
                <div class="col-lg-3">
                    <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                        <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i
                            class="fa-solid fa-money-check-dollar"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Balance</h6>
                                <span>৳ {{ number_format($vendor->balance ?? 0, 2) }}</span>
                                {{-- <span class="text-sm"> In {{ number_format($categoryCount->total_categories) }} Categories
                                </span> --}}
                            </div>
                        </article>
                    </div>
                </div>
        @endif
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow p-3 mb-5 bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa-solid fa-truck-fast"></i></span>
                    <div class="text">
                        <a href="{{ route('all_orders.index', ['delivery_status' => 'Processing']) }}">
                            <h6 class="mb-1 card-title">Processing Orders</h6>
                            <span> {{ process_order('processing') }}</span>
                            {{-- <span class="text-sm"> Excluding orders in transit </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @endif
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i
                            class=" material-icons md-qr_code"></i></span>
                    <div class="text">
                        <a href="{{ route('all_orders.index', ['delivery_status' => 'Waiting']) }}">
                            <h6 class="mb-1 card-title">Waiting Orders</h6>
                            <span> {{ process_order('waiting') }}</span>
                            {{-- <span class="text-sm"> In {{ number_format($categoryCount->total_categories) }} Categories
                            </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="fa-solid fa-user-tie"></i></span>
                    <div class="text">
                        <a href="{{ route('return-request.all') }}">
                            <h6 class="mb-1 card-title">Return Request</h6>
                            <span>{{ return_request() }}</span>
                            {{-- <span class="text-sm"> Who are active. </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa-solid fa-clipboard-user"></i></span>
                    <div class="text">
                        <a href="{{ route('all_orders.index') }}?delivery_status=&payment_status=&date={{ \Carbon\Carbon::yesterday()->format('m') }}%2F{{ \Carbon\Carbon::yesterday()->format('d') }}%2F{{ \Carbon\Carbon::yesterday()->format('Y') }}+-+{{ \Carbon\Carbon::yesterday()->format('m') }}%2F{{ \Carbon\Carbon::yesterday()->format('d') }}%2F{{ \Carbon\Carbon::yesterday()->format('Y') }}">
                            <h6 class="mb-1 card-title">Yesterday Orders</h6>
                            <span>{{ yesterday_total_order() }}</span>
                            {{-- <span class="text-sm"> In {{ number_format($categoryCount->total_categories) }} Categories
                            </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @endif
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa-solid fa-copyright"></i></span>
                    <div class="text">
                        <a href="{{ route('all_orders.index') }}?delivery_status=&payment_status=&date={{ \Carbon\Carbon::yesterday()->format('m') }}%2F{{ \Carbon\Carbon::yesterday()->format('d') }}%2F{{ \Carbon\Carbon::yesterday()->format('Y') }}+-+{{ \Carbon\Carbon::yesterday()->format('m') }}%2F{{ \Carbon\Carbon::yesterday()->format('d') }}%2F{{ \Carbon\Carbon::yesterday()->format('Y') }}">
                            <h6 class="mb-1 card-title">Yesterday Sales</h6>
                            <span>৳ {{ yesterday_total_sales() }}</span>
                            {{-- <span class="text-sm"> All brands </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa-solid fa-users"></i></span>
                    <div class="text">
                        <a href="{{ route('messages.list') }}">
                            <h6 class="mb-1 card-title">Complaints</h6>
                            <span>{{ total_complaints()}}</span>
                            {{-- <span class="text-sm"> Who are selling products here. </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
        @endif
        <div class="col-lg-3">
            <div class="card card-body mb-4 shadow bg-white rounded" style="border: 1px solid #365486">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="fa-solid fa-battery-quarter"></i></span>
                    <div class="text">
                        <a href="{{ route('stock_report.index', ['select_type' => 'low']) }}">
                            <h6 class="mb-1 card-title">Low Stocks</h6>
                            <span>{{ number_format($lowStockCount->total_low_stocks) }}</span>
                            {{-- <span class="text-sm"> Products having stock <= 5 </span> --}}
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <br>
    @if(Auth::guard('admin')->user()->role == 1)
        <div class="card mb-4 shadow bg-white rounded">
                <header class="card-header">
                    <h2 class="text-white">Pending Orders</h2>
                </header>
                {{-- <section class="content-main">
                    <div class="content-header">
                        <div>
                            <h2 class="content-title card-title">Order List</h2>
                        </div>
                    </div> --}}
                {{-- <div class="card">
                                <!-- card-header end// -->
                                <div class="card-body"> --}}
                <form class="" action="" method="GET">
                    {{-- <div class="form-group row mb-3">
                                        <div class="col-md-2">
                                            <label class="col-form-label"><span>All Orders :</span></label>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="custom_select">
                                               <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="vendor_id" id="vendor_id">
                                                    <option value="" selected="">Vendor</option>
                                                    <option value="0">AA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="custom_select">
                                                <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                                    <option value="" selected="">Delivery Status</option>
                                                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                                    <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                                    <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                                                    <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                                    <option value="on_the_way" @if ($delivery_status =='on_the_way') selected @endif>On The Way</option>
                                                    <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="custom_select">
                                               <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="payment_status" id="payment_status">
                                                    <option value="" selected="">Payment Status</option>
                                                    <option value="0" @if ($payment_status == '0') selected @endif>Unpaid</option>
                                                    <option value="1" @if ($payment_status == '1') selected @endif>Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="custom_select">
                                                <input type="text"   id="reportrange" class="form-control"  name="date" placeholder="Filter by date" data-format="DD-MM-Y" value="Filter by date" data-separator=" - " autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                        </div>
                                    </div> --}}
                    <div class="card-body table-responsive-sm">
                        <table class="table table-bordered table-hover" width="100%">
                            <thead style="background-color: #dbe8f3;">
                            <tr>
                                <th>Order Code</th>
                                <!-- <th>Num. Of Products</th> -->
                                <th>Customer name</th>
                                <th>Amount</th>
                                <th>Delivery Status</th>
                                <th>Payment Status</th>
                                <th class="text-end">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                           @if(count($orders) > 0)
                               @foreach ($orders as $key => $order)
                                   <tr>
                                       <td>{{ $order->invoice_no }}</td>
                                       <td><b>{{ $order->name }}</b></td>
                                       <td>
                                               <?php
                                               $discount_total = $order->grand_total-$order->discount;
                                               $total_ammount = $discount_total+$order->shipping_charge;
                                               ?>
                                           {{ $total_ammount }}
                                       </td>
                                       <td>
                                           @php
                                               $status = $order->delivery_status;
                                               if($order->delivery_status == 'cancelled') {
                                               $status = '<span class="badge rounded-pill alert-success">Received</span>';
                                               }
                                           @endphp
                                           {!! $status !!}
                                       </td>
                                       <td>
                                           @if ($order->payment_status == '1')
                                               <span class="badge rounded-pill alert-success">Paid</span>
                                           @else
                                               <span class="badge rounded-pill alert-danger">Un-Paid</span>
                                           @endif
                                       </td>
                                       <td class="text-end">
                                           <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                              href="{{route('all_orders.show',$order->id) }}" style="background-color: #308fde !important;">
                                               <i class="fa-solid fa-eye"></i>
                                           </a>
                                           <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                              href="{{ route('invoice.download', $order->id) }}">
                                               <i class="fa-solid fa-download"></i>
                                           </a>
                                           <form action="{{ route('delete.orders', $order->id) }}" method="POST" class="delete-form d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-primary btn-icon btn-circle btn-sm btn-xs delete-btn"
                                                    style="background-color: red!important">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                       </td>

                                       <!--  <td class="text-end">
                                                           <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                           <div class="dropdown">
                                                               <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                               <div class="dropdown-menu">
                                                                   <a class="dropdown-item" href="#">View detail</a>
                                                                   <a class="dropdown-item" href="#">Edit info</a>
                                                                   <a class="dropdown-item text-danger" href="#">Delete</a>
                                                               </div>
                                                           </div>
                                                       </td> -->
                                   </tr>
                               @endforeach
                           @else
                               <tr>
                                   <td colspan="6" class="text-center fw-bold"> No Pending Orders</td>
                               </tr>
                           @endif

                    </tbody>
                </table>
                <div class="pagination-area mt-25 mb-50">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $orders->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </form>
        <!-- table-responsive //end -->
        {{-- </div>
                        <!-- card-body end// -->
                    </div>
                </form>
                <!-- table-responsive //end -->
                {{-- </div>
                                <!-- card-body end// -->
                            </div>
                            <!-- card end// --> --}}
                {{-- </div>
                    </div>
                </section> --}}
            </div>
    @elseif(Auth::guard('admin')->user()->role == 2 )
        <div class="card mb-4 shadow bg-white rounded">
            <div class="card-header"><h2 class="text-white">Sold Products</h2></div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Product ID</th>
                        <th>Sold Quantities</th>
                        <th>Amount</th>
                        @php $i=1; @endphp
                    </tr>
                    @php $vendor = \App\Models\Vendor::where('user_id', Auth::guard('admin')->user()->id)->first(); @endphp
                    @foreach($products as $product)
                        @if($product->product)
                            @if($product->product->vendor_id == $vendor->id)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$product->product->name_en ?? ''}}</td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{$product->amount}}</td>
                                </tr>
                            @endif

                        @endif
                    @endforeach
                    @if($i == 1)
                        <tr>
                            <td colspan="5" class="text-center"><span>No Data Found</span></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @endif

</section>
@endsection

@push('footer-script')
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            let form = $(this).closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
