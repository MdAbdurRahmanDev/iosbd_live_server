@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <div class="col-md-10">
            <h2 class="content-title">Category List</h2>
            <strong style="font-weight: bold" class="text-dark"> {{ count($categories) }} Products Found </strong>

        </div>
        @if(Auth::guard('admin')->user()->role == '1' || in_array('6', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
        <div class="col-md-2">
            <a href="{{ route('category.create') }}" class="btn btn-primary" title="Add Category"><i class="material-icons md-plus"></i></a>
        </div>
        @endif
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name <span class="d-none">(English)/(Bangla)</span></th>
{{--                            <th scope="col">Name (Bangla)</th>--}}
                            <th scope="col">Type</th>
{{--                            <th scope="col">Parent</th>--}}
                            <th scope="col">Status</th>
                            <th scope="col">Featured</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($category->image) }}" class="img-sm img-avatar" alt="Userpic" style="border-radius: 0 !important;"/>
                                    </div>
                                </a>
                            </td>
	                        <td>
                                {{ $category->name_en ?? '' }} <br><span class="d-none">{{ $category->name_bn ?? '' }}</span>

                            </td>
	                        <td>
                             @if($category->type==1)
                                Parent Category <br> {{ $category->parent_name != null ? '('.$category->parent_name.')':'' }}
                             @elseif($category->type==2)
                                Sub Category
                             @elseif($category->type==3)
                                Sub Sub Category
                             @endif

                            </td>

                            <td>
                                @if($category->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role == 1 || in_array('7', json_decode(Auth::guard('admin')->user()->staff->role->permissions))) href="{{ route('category.in_active',['id'=>$category->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role == 1 || in_array('7', json_decode(Auth::guard('admin')->user()->staff->role->permissions))) href="{{ route('category.active',['id'=>$category->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td>
                                @if($category->is_featured == 1)
                                    <a @if(Auth::guard('admin')->user()->role == 1 || in_array('7', json_decode(Auth::guard('admin')->user()->staff->role->permissions))) href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}"@endif title="Featured Category">
                                        <span class="feature-status text-success"><i class="fa-solid fa-tag"></i></span>
                                    </a>
                                @else
                                    <a @if(Auth::guard('admin')->user()->role == 1 || in_array('7', json_decode(Auth::guard('admin')->user()->staff->role->permissions))) href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}" @endif title="Normal Category">
                                        <span class="feature-status text-danger"><i class="fa fa-tag"></i></span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td >
                                    <div class=" btn-group" style="margin: 25% 0">
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('7', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary" title="Edit"
                                               style="padding:12px; margin-right: 5px; border-radius: 5px"><i class="fa fa-pencil"></i></a>
                                           
                                        @endif
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('8', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                        <form action="{{ route('category.delete', $category->id) }}" method="POST" class="delete-form d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-danger delete-btn" title="Delete" style="border-radius: 5px">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                         @endif

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
