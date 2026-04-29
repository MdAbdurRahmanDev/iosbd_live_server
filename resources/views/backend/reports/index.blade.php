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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product Wise Stock Report</h2>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-10">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                   <div class="card-body">
				                <form action="{{ route('stock_report.index') }}" id="filterForm" method="GET">
				                    <div class="form-group row mb-3">
				                        <div class="col-md-6">
                                            <label class="col-md-6 col-form-label">Category :</label>
				                        	<div class="custom_select">
				                        		<select class="form-select select-active select-nice" id="category_id" aria-label="Default select example" name="category_id">
                                                    <option value="">All</option>
                                                    @foreach (\App\Models\Category::all() as $key => $category)
                                                        <option value="{{ $category->id }}" @isset($_GET['category_id']){{$_GET['category_id'] == $category->id ? 'selected':''}}@endisset>{{ $category->name_en }}</option>
                                                    @endforeach
                                                </select>
				                        	</div>
				                        </div>
{{--				                        <div class="col-md-2">--}}
{{--				                            <button class="btn btn-primary" style="padding-bottom: 12px;" type="submit"><i class="fa fa-filter" style="padding-top: 10px;"></i></button>--}}
{{--				                        </div>--}}

                                    <div class="col-md-6">
                                        <label class="col-md-6 col-form-label">Stock Type:</label>
                                        <div class="custom_select">
                                            <select class="form-select select-active select-nice" id="stockType" name="select_type" >
                                                <option value="all" {{ request('select_type') == 'all' ? 'selected' : '' }}>All Stock</option>
                                                <option value="low" {{ request('select_type') == 'low' ? 'selected' : '' }}>Low Stock</option>
                                            </select>
                                        </div>
                                    </div>
				                    </div>
				                </form>
				                <table  class="table table-bordered table-hover mb-0">
				                    <thead>
				                        <tr>
				                            <th>Product Name</th>
				                            <th>Image</th>
				                            <th class="text-center">Variant</th>
				                            <th class="text-center">Stock</th>
				                            {{-- <th class="text-center">Low Stock</th> --}}
                                            <th>Unit Price</th>
                                            <th>Stock Price</th>
				                        </tr>
                                    @php $total_stock_price=0; @endphp
				                    </thead>
				                    @if($products->count() > 0)
                                        <tbody>
                                            @php
                                                $total_unit_price = 0;
                                                $total_stock_price = 0;
                                                $total_unit_qty = 0;
                                            @endphp

                                            @foreach ($products as $product)
                                            @if($product->is_varient === 1 && $product->stocks->count() > 0)

                                                    @foreach ($product->stocks as $stock)
                                                        @php
                                                            $unit_price = floatval($stock->price);
                                                            $stock_price = $unit_price * intval($stock->qty);

                                                            $total_unit_price += $unit_price;
                                                            $total_stock_price += $stock_price;
                                                            $total_unit_qty += intval($stock->qty);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $product->name_en }}</td>
                                                            <td>
                                                                <img src="{{ asset($product->product_thumbnail) }}" alt="" height="50" width="50">
                                                            </td>
                                                            <td class="text-center">{{ $stock->varient }}</td>
                                                            <td class="text-center">{{ $stock->qty }}</td>
                                                            <td class="text-center">৳{{ number_format($unit_price, 2) }}</td>
                                                            <td class="text-center">৳{{ number_format($stock_price, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $unit_price = floatval($product->regular_price ?? 0);
                                                    $stock_price = $unit_price * intval($product->stock_qty ?? 0);
                                                        $total_unit_price += $unit_price;
                                                        $total_stock_price += $stock_price;
                                                        $total_unit_qty += intval($product->stock_qty);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $product->name_en }}</td>
                                                        <td>
                                                            <img src="{{ asset($product->product_thumbnail) }}" alt="" height="50" width="50">
                                                        </td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">{{ $product->stock_qty }}</td>
                                                        <td class="text-center">৳{{ number_format($unit_price, 2) }}</td>
                                                        <td class="text-center">৳{{ number_format($stock_price, 2) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            {{-- Total row --}}
                                            <tr>
                                                <th colspan="3" class="text-right">Total</th>
                                                <td class="text-center"><strong>{{ $total_unit_qty }}</strong></td>  {{-- Total Unit Quantity --}}
                                                <td class="text-center"><strong>৳{{ number_format($total_unit_price, 2) }}</strong></td> {{-- Total Unit Price --}}
                                                <td class="text-center"><strong>৳{{ number_format($total_stock_price, 2) }}</strong></td> {{-- Total Stock Price --}}
                                            </tr>
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center">There Are No Products.</td>
                                            </tr>
                                        </tbody>
                                    @endif
				                </table>
				                {{-- <div class="pagination-area mt-25 mb-50">
		                            <nav aria-label="Page navigation example">
		                                <ul class="pagination justify-content-end">
		                                    {{ $products->links() }}
		                                </ul>
		                            </nav>
		                        </div> --}}
				            </div>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>
@endsection

@push('footer-script')
<script>
    
    $(document).ready(function () {
        function updateFilter(param, value) {
            let url = new URL(window.location.href);
            if (value) {
                url.searchParams.set(param, value);
            } else {
                url.searchParams.delete(param);
            }
            window.location.href = url.toString();
        }

        $('#category_id').on('change', function () {
            updateFilter('category_id', $(this).val());
        });

        $('#stockType').on('change', function () {
            updateFilter('select_type', $(this).val());
        });
    });


</script>
@endpush
