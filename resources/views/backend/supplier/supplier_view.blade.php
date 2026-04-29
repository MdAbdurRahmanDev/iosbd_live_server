@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="content-title">Supplier List</h3>
                <strong class="text-dark" style="font-weight: bold;">{{ count($suppliers) }} Supplier Found</strong>
            </div>
            <div>
                <a href="{{ route('supplier.pdf') }}" class="btn btn-success">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
                <a href="{{ route('supplier.create') }}" class="btn btn-primary" title="Supplier Create">
                    <i class="material-icons md-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name ?? '' }} </td>
                            <td> {{ $item->phone ?? '' }} </td>
                            <td> {{ $item->email ?? '' }} </td>
                            <td> {{ $item->address ?? '' }} </td>
                            <td>
                                @if($item->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.in_active',['id'=>$item->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.active',['id'=>$item->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                            <td class="text-end">
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary" style="padding:12px" href="{{ route('supplier.edit', $item->id) }}" title="Edit Info">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <form action="{{ route('supplier.destroy', $item->id) }}" method="GET" class="delete-form d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-danger delete-btn" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection

@push('footer-script')
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault(); // Prevent form submission

            let form = $(this).closest('form'); // Get the closest form

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
                    form.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>
@endpush
