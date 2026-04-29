@extends('admin.admin_master')
@section('admin')
<style>
    .modal {
        overflow: hidden !important;
        animation: none !important;
    }
    .modal-backdrop {
        display: none !important;
    }
</style>
    <section class="content-main">
        <div class="content-header">
            <div class="col-md-10">
                <div class="">
                    <h2 class="">User Messages</h2>
                </div>
                <strong style="font-weight: bold" class="text-dark"> {{ count($items) }} Messages Found </strong>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $key => $message)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $message->created_at ? $message->created_at->format('Y-m-d') : 'No Date' }} </td>
                                <td> {{ $message->purpose ?? 'No Type' }} </td>
                                <td> {{ $message->name ?? 'No Name' }} </td>
                                <td> {{ $message->email ?? 'No Email' }} </td>
                                <td> {{ $message->subject ?? 'No Subject' }} </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-icon btn-circle btn-sm btn-xs viewMessage"
                                    data-id="{{ $message->id }}"
                                    data-date="{{ $message->created_at ? $message->created_at->format('Y-m-d') : 'No Date' }}"
                                    data-type="{{ $message->purpose ?? 'No Type' }}"
                                    data-name="{{ $message->name ?? 'No Name' }}"
                                    data-email="{{ $message->email ?? 'No Email' }}"
                                    data-subject="{{ $message->subject ?? 'No Subject' }}"
                                    data-message="{{ $message->message ?? 'No Message' }}"
                                    data-image="{{ asset( $message->image ) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    <form id="delete-form-{{ $message->id }}" action="{{ route('messages.delete', $message->id) }}" method="POST" style="display: inline;">
                                        @csrf

                                        <a href="javascript:void(0);" onclick="confirmDelete({{ $message->id }})"
                                           class="btn btn-danger btn-sm btn-xs " style="background-color: red !important; border-color: red !important;">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
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
        <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewMessageModalLabel">Message Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li class="pb-2"><strong class="text-dark">Date:</strong> <span id="modal-date"></span></li>
                            <li class="pb-2"><strong class="text-dark">Type:</strong> <span id="modal-type"></span></li>
                            <li class="pb-2"><strong class="text-dark">Name:</strong> <span id="modal-name"></span></li>
                            <li class="pb-2"><strong class="text-dark">Email:</strong> <span id="modal-email"></span></li>
                            <li class="pb-2"><strong class="text-dark">Subject:</strong> <span id="modal-subject"></span></li>
                            <li class="pb-2"><strong class="text-dark">Message:</strong> <p id="modal-message" class="border p-2 rounded bg-light"></p></li>
                            <li class="mt-2"><strong class="text-dark">Image:</strong></li>
                            <li class="pb-2">
                                <img id="modal-image" src="" class="img-thumbnail d-block mx-auto mt-2" style="max-width: 150px; max-height: 150px;">
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer-script')
<script>
    function confirmDelete(id) {
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
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    </script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.viewMessage', function (e) {
            e.preventDefault();

            let date = $(this).data('date');
            let type = $(this).data('type');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let subject = $(this).data('subject');
            let message = $(this).data('message');
            let image = $(this).data('image');

            $('#modal-date').text(date);
            $('#modal-type').text(type);
            $('#modal-name').text(name);
            $('#modal-email').text(email);
            $('#modal-subject').text(subject);
            $('#modal-message').text(message);
            $('#modal-image').attr('src', image);

            $('#viewMessageModal').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');
        });
    });
    </script>



@endpush
