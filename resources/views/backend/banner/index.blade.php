@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <div class="col-md-10">
            <h2 class="content-title">Banner List</h2>
            <strong style="font-weight: bold" class="text-dark"> {{ count($banners) }} Banners Found </strong>

        </div>
        <div class="col-md-2">
            <a href="{{ route('banner.create') }}" class="btn btn-primary" title="Add Banner"><i class="material-icons md-plus"></i></a>
        </div>

    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Banner Photo</th>
                            <th scope="col">Title </th>
{{--                            <th scope="col">Title (Bangla)</th>--}}
                            <th scope="col">Position</th>
                            <th scope="col">Banner Url</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $key => $banner)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($banner->banner_img) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $banner->title_en ?? 'NULL' }} </td>
                            @if($banner->position == 1)
                                <td>First Banner</td>
                            @elseif($banner->position == 2)
                                <td>Second Banner</td>
                            @endif
                            <td> {{ $banner->banner_url ?? '#' }} </td>
                            <td>
                                @if($banner->status == 1)
                                  <a href="{{ route('banner.in_active',['id'=>$banner->id]) }}">
                                    <span class="badge status rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('banner.active',['id'=>$banner->id]) }}" > <span class="badge status rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class=" btn-group" style="margin: 25% 0">
                                    <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-primary" title="Edit"
                                       style="padding:12px; margin-right: 5px; border-radius: 5px"><i class="fa fa-pencil"></i></a>
                                    {{-- <a href="{{ route('banner.delete',$banner->id) }}" id="delete" class="btn btn-danger" title="Delete"
                                       style="border-radius: 5px"><i class="fa fa-trash"></i></a> --}}
                                       <form action="{{ route('banner.delete',$banner->id) }}" method="GET" class="delete-form" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-danger delete-btn" title="Delete" style="border-radius: 5px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

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
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');

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
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
