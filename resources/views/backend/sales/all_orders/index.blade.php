@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>

<section class="content-main">
    <div class="content-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="content-title card-title">Order List</h2>
        </div>
        <div style="padding-right: 2rem">
            <h3 class="content-title card-title">Total Amount: <span id="totalAmount">{{ $suball_amount ?? 0 }}</span></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <!-- card-header end// -->
                <div class="card-body">
                    <form class="" action="" method="GET">
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <!--<label class="col-form-label"><span>All Orders :</span></label>-->
                        </div>
                        <div class="col-md-2 mt-2">
{{--                            <div class="custom_select">--}}
{{--                               <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="vendor_id" id="vendor_id">--}}
{{--                                    <option value="" selected="">Vendor</option>--}}
{{--                                    <option value="0">AA</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                    <option value="" selected="">Delivery Status</option>
                                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                    <option value="Processing" @if ($delivery_status == 'Processing') selected @endif>Processing</option>
                                    <option value="Waiting" @if ($delivery_status == 'Waiting') selected @endif>Waiting</option>
                                    <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                                    <option value="Delivered" @if ($delivery_status == 'Delivered') selected @endif>Delivered</option>
                                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                </select>
                                {{-- <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                    <option value="" selected="">Delivery Status</option>
                                    <option value="pending" {{ request('delivery_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processing" {{ request('delivery_status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Waiting" {{ request('delivery_status') == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                    <option value="Delivered" {{ request('delivery_status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                </select> --}}
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
                        <div class="col-md-3 mt-2">
                            <div class="custom_select">
                                <input type="text" style="width: 190px"   id="reportrange" class="form-control"  name="date" placeholder="Filter by date" data-format="DD/MM/YYYY" value="Filter by date" data-separator="-" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-1 mt-2">
                            <button class="btn btn-primary p-3 mx-3" type="submit"><i class="fa fa-filter"></i></button>
                        </div>
                    </div>
                    </form>
                    <div class="table-responsive-sm">
                        <table  class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <!-- <th>Num. Of Products</th> -->
                                    <th>Customer name</th>
                                    <th>Amount</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Comment</th>
                                    <th class="text-end">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders)>0)
                                    @php
                                        $total_amount = 0;
                                    @endphp
                                	@foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date_format($order->created_at, 'd/m/Y') }}</td>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td><b>{{ $order->name }}</b></td>
                                        <td>
                                            {{$order->grand_total}}
                                            <?php
                                                $total_amount += $order->grand_total;
                                            ?>
                                        </td>
                                        <td>
                                        	@php
    			                                $status = $order->delivery_status;
    			                                if($order->delivery_status == 'cancelled') {
    			                                    $status = '<span class="badge rounded-pill alert-dark">Cancelled</span>';
    			                                }else if($order->delivery_status == 'pending') {
    			                                    $status = '<span class="badge rounded-pill alert-danger">Pending</span>';
    			                                }else if($order->delivery_status == 'processing') {
    			                                    $status = '<span class="badge rounded-pill alert-primary">Processing</span>';
    			                                }else if($order->delivery_status == 'waiting') {
    			                                    $status = '<span class="badge rounded-pill alert-warning">Waiting</span>';
    			                                }else if($order->delivery_status == 'shipped') {
    			                                    $status = '<span class="badge rounded-pill alert-info">Shipped</span>';
    			                                }else if($order->delivery_status == 'delivered') {
    			                                    $status = '<span class="badge rounded-pill alert-success">Delivered</span>';
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
                                        <td><b>{{ $order->comment ?? '' }} </b></td>
                                        <td class="text-end">
                                            @if(Auth::guard('admin')->user()->role == 1 || in_array('18', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
    			                            <a  class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"  href="{{route('all_orders.show',$order->id) }}">
    			                                <i class="fa-solid fa-eye"></i>
    			                            </a>
    			                            <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" style="background-color: #106390 !important;" href="{{ route('invoice.download', $order->id) }}">
    			                                <i class="fa-solid fa-download"></i>
    			                            </a>
    			                            @endif
    			                            @if(Auth::guard('admin')->user()->role == 1 || in_array('20', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
    			                            <form id="delete-form-{{ $order->id }}" action="{{ route('delete.orders', $order->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $order->id }})" class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" style="background-color: red !important;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                            @endif
    			                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-end"><strong class="text-dark">Total Amount:</strong></td>
                                        <td colspan="5"><strong>{{ $total_amount }}</strong></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-center" colspan="9">No order found!</td>
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
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </div>
        <!-- <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Filter by</h5>
                    <form>
                        <div class="mb-4">
                            <label for="order_id" class="form-label">Order ID</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_id" />
                        </div>
                        <div class="mb-4">
                            <label for="order_customer" class="form-label">Customer</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_customer" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Order Status</label>
                            <select class="form-select">
                                <option>Published</option>
                                <option>Draft</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="order_total" class="form-label">Total</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_total" />
                        </div>
                        <div class="mb-4">
                            <label for="order_created_date" class="form-label">Date Added</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_created_date" />
                        </div>
                        <div class="mb-4">
                            <label for="order_modified_date" class="form-label">Date Modified</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_modified_date" />
                        </div>
                        <div class="mb-4">
                            <label for="order_customer_1" class="form-label">Customer</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_customer_1" />
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</section>

@push('footer-script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(function() {

    $('input[name="date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + '-' + picker.endDate.format('DD/MM/YYYY'));
  });

  // $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
  //     $(this).val('');
  // });


    var start = moment().subtract(29, 'days');
    var end = moment();

    // start = '';
    // end = '';
    
    @isset($date)
        @if($date !='')
            var fullDate = '{{ $date }}';
            const myDateArray = fullDate.split("-");
            
            start = myDateArray[0];
            end = myDateArray[1];
        @endif
    @endisset


    $('input[name="date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

    function cb(start, end) {
        $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
        @isset($date)
            @if($date !='')
                $('#reportrange').html({{ $date }});
            @endif
        @endisset
    }

    $('#reportrange').daterangepicker({

        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>
<script>
    $(document).ready(function () {
        $('#delivery_status').on('change', function () {
            var selectedStatus = $(this).val();

            window.location.href = "{{ route('all_orders.index') }}?delivery_status=" + selectedStatus;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#payment_status').on('change', function () {
            var selectedStatus = $(this).val();

            window.location.href = "{{ route('all_orders.index') }}?payment_status=" + selectedStatus;
        });
    });
</script>


<script>
    function confirmDelete(orderId) {
        console.log("'"+orderId+"'")
        console.log("Deleting Order ID:", orderId);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                let formId = "delete-form-"+orderId;
                console.log(formId);
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush

@endsection
