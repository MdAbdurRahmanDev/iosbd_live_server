@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        {{-- <h3 class="content-title">Staff list
             {{-- <span class="badge rounded-pill alert-success"> {{ count($staffs) }} </span>
             <strong style="font-weight: bold" class="text-dark">{{ count($staffs) }} Staff Found </strong>
            </h3> --}}
            <div class="col-md-10">
                <div class="">
                    <h2 class="">Staff List</h2>
                </div>
                <strong style="font-weight: bold" class="text-dark"> {{ count($staffs) }} Staff Found </strong>
            </div>
        <div>
            <a href="{{ route('staff.create') }}" title="Add Staff" class="btn btn-primary"><i class="material-icons md-plus"></i></a>
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
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffs as $key => $staff)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $staff->user->name ?? 'NULL' }} </td>
                            <td> {{ $staff->user->email ?? 'NULL' }} </td>
                            <td> {{ $staff->user->phone ?? 'NULL' }} </td>
                            <td> {{ $staff->role->name ?? 'NULL' }} </td>
                            <td>
                                <a  class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('staff.edit',$staff->id) }}">
			                        <i class="fa-solid fa-edit"></i>
			                    </a>

			                    <form action="{{ route('staff.destroy', $staff->id) }}" method="GET" class="delete-form d-inline">
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
            e.preventDefault(); // Prevent default action

            let form = $(this).closest('form'); // Get the closest form

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
                    form.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>
@endpush
