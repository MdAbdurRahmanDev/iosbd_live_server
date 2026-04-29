@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row content-header">
{{--        <div class="">--}}
            <div class="col-md-9">
                <h2 class="content-title">Slider List</h2>
                <strong style="font-weight: bold; color: #365486"> {{ count($sliders) }} Sliders Found</strong>
            </div>
            <div class="col-md-3">
                <div>
                    <a href="{{ route('slider.create') }}" style="float: right; margin-right: 20px" class="btn btn-primary" title="Add Slider"><i class="material-icons md-plus"></i> </a>
                </div>
            </div>
{{--        </div>--}}
    </div>
    <div class="card mb-4">
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Slider Img</th>
                        <!--<th>Title </th>-->
{{--                        <th>Description (Bangla)</th>--}}
                        <!--<th>Description</th>-->
                        <!--<th>Type</th>-->
                        <th>Status</th>
                        <th class="text-end">Action</th>
                      </tr>
                    </thead>
                        <tbody>
                            @foreach($sliders as $key => $slide)
                              <tr>
                                <td> {{ $key+1}} </td>
                                <td width="15%">
                                    <a href="#" class="itemside">
                                        <div class="left">
                                            <img src="{{ asset($slide->slider_img) }}" class="img-sm" alt="slider image" style="width: 100px !important; height: 100% !important">
                                        </div>
                                    </a>
                                </td>
                                <!--<td> {{ $slide->title_en ?? 'NULL' }} </td>-->
{{--                                <td> {{ $slide->description_bn ?? 'NULL' }} </td>--}}
                                <!--<td> {{ $slide->description_en ?? 'NULL' }} </td>-->
                                  <!--<td>{{$slide->type == 1 ? "Header Slider":'Middle Slider'}}</td>-->
                                <td>
                                    <div>
                                        @if($slide->status == 1)
                                            <a href="{{ route('slider.in_active',['id'=>$slide->id]) }}">
                                                <span class="slider-status badge rounded-pill alert-success">Active</span>
                                            </a>
                                        @else
                                            <a href="{{ route('slider.active',['id'=>$slide->id]) }}" > <span class="slider-status badge rounded-pill alert-danger">Disable</span></a>
                                        @endif
                                    </div>
                                </td>
                                <td >
                                    <div class=" btn-group" style="margin: 10px 0; float: right">
                                        <a href="{{ route('slider.edit',$slide->id) }}" class="btn btn-primary" title="Edit"
                                           style="padding:12px; margin-right: 5px; border-radius: 5px"><i class="fa fa-pencil"></i></a>
                                        {{-- <a href="{{ route('slider.destroy',$slide->id) }}" class="btn btn-danger" title="Delete"
                                           style="border-radius: 5px"><i class="fa fa-trash"></i></a> --}}
                                           <form action="{{ route('slider.destroy', $slide->id) }}" method="GET" class="delete-form" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-danger delete-btn" title="Delete" style="border-radius: 5px">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                    </div>
{{--                                    <a href="#" class="btn btn-md rounded font-sm">Detail</a>--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>--}}
{{--                                        <div class="dropdown-menu">--}}
{{--                                            <a class="dropdown-item" href="{{ route('slider.edit',$slide->id) }}">Edit info</a>--}}
{{--                                            <a class="dropdown-item text-danger" href="{{ route('slider.destroy',$slide->id) }}" id="delete">Delete</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- dropdown //end -->
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- card end// -->
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
