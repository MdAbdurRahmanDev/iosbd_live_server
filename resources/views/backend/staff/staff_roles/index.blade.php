@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        {{-- <h3 class="content-title">Role list <span class="badge rounded-pill alert-success"> {{ count($roles) }} </span></h3> --}}
        <div class="col-md-10">
            <div class="">
                <h2 class="">Role List</h2>
            </div>
            <strong style="font-weight: bold" class="text-dark"> {{ count($roles) }} Roles Found </strong>
        </div>
        <div>
            <a href="{{ route('roles.create') }}" title="Add Role" class="btn btn-primary"><i class="material-icons md-plus"></i></a>
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $role->name ?? 'NULL' }} </td>
                            <td>
                                <a  class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('roles.edit', $role->id) }}">
			                        <i class="fa-solid fa-edit"></i>
			                    </a>
			                    {{-- <a  href="{{route('roles.destroy', $role->id)}}" id="delete" class="btn btn-danger btn-icon btn-circle btn-sm btn-xs" data-href="#" style="background-color:red !important ">
			                        <i class="fa-solid fa-trash"></i>
			                    </a> --}}
                                <form action="{{ route('roles.destroy', $role->id) }}" method="GET" class="delete-form d-inline">
                                    @csrf
                                    <button type="button" class="btn btn-danger delete-btn" title="Delete" style="border-radius: 5px">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

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
