@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Subscribers List <span class="badge rounded-pill alert-success"> {{ count($subscribers) }} </span></h2>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $key => $subscribe)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $subscribe->email ?? 'NULL' }} </td>
                            <td> {{ date('d-m-Y', strtotime($subscribe->created_at)) }} </td>
                            <td class="text-end">
                                {{-- <a href="{{ route('subscribers.destroy', $subscribe->id) }}" id="delete" class="btn btn-md rounded font-sm">Delete</a> --}}
                                <!-- dropdown //end -->
                                <form action="{{ route('subscribers.destroy', $subscribe->id) }}" method="GET" class="delete-form d-inline">
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
