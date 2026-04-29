@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h3 class="content-title">Attribute List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($attributes) }} Attributes Found</strong>
            </div>
             @if(Auth::guard('admin')->user()->role == 1 || in_array('14', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
            <div class="col-md-3">
                <a href="{{ route('attribute.create') }}" class="btn btn-primary px-3 text-align-right" style="float: right; margin-right: 20px" title="Add Attribute"><i class="material-icons md-plus"></i></a>
            </div>
            @endif
            <div class="col-1"></div>
        </div>
    </div>
    <div class=" mt-3 card mb-4 col-10 mx-auto">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Value</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $key => $attribute)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $attribute->name ?? 'NULL' }} </td>

                            <td>
                            @foreach($attribute->attribute_values as $value)
                                 {{ $value->value ?? 'NULL' }} ,
                            @endforeach
                            </td>
                            <td class="text-end">
                                @if(Auth::guard('admin')->user()->role == 1 || in_array('15', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                    <a href="{{ route('attribute.show',$attribute->id) }}" class="btn" style="background-color: #308fde; color: white" title="Details"><i class="fa fa-eye"></i></a>
                                    <a style="padding:12px;" class="btn btn-primary" href="{{ route('attribute.edit',$attribute->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                @endif
                                @if(Auth::guard('admin')->user()->role == 1 || in_array('16', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                    <form action="{{ route('attribute.delete', $attribute->id) }}" method="GET" class="delete-form d-inline">
                                        @csrf
                                        {{-- @method('DELETE') --}}
                                        <button type="button" class="btn btn-danger delete-btn" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                @endif
                                <!-- dropdown //end -->
                            </td>
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
        $(document).on('click', '.delete-btn', function(e) { 
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
