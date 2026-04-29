@extends('FrontEnd.master')
@section('title')
    Review Product
@endsection
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>

    .rating-star i {
        color: #f2ca06;
        font-size: 16px;
        transition: color 0.2s;
    }

    .rating-star.active i {
        color: #f5f4f3;
    }

    .btn-close {
        background-color: #ff6b6b;
        border: none;
        color: white;
        font-size: 16px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-close:hover {
        background-color: #f04040;
    }

    .btn-close:focus {
        outline: none;
        box-shadow: none;
    }

    input[type=checkbox], input[type=radio] {
        display: none;
    }

    [type="radio"]:checked + label:before, [type="radio"]:not(:checked) + label:before {
        display: none;
    }

    [type="radio"]:checked + label:after {
        display: none;
    }

    .rating-container {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: nowrap;
        max-width: 100%;
        overflow: hidden;
    }

    .rating-star i {
        color: #f2ca06;
        font-size: 20px;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .rating-star:hover i {
        transform: scale(1.2);
        color: #ffdd57;
    }
    @media(min-width: 992px){
        .rating-container {
            gap: 6px;
        }
        .rating-star i {
            font-size: 16px;
        }
        .btn-close {
            background-color: #ff6b6b;
            border: none;
            color: white;
            font-size: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close:hover {
            background-color: #f04040;
        }
    }

    @media (max-width: 768px) {
        .rating-container {
            gap: 6px;
        }
        .rating-star i {
            font-size: 14px;
        }
        .btn-close {
            background-color: #ff6b6b;
            border: none;
            color: white;
            font-size: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close:hover {
            background-color: #f04040;
        }
    }

    @media (max-width: 576px) {
        .rating-container {
            gap: 4px;
        }
        .rating-star i {
            font-size: 12px;
        }
        .btn-close {
            background-color: #ff6b6b;
            border: none;
            color: white;
            font-size: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close:hover {
            background-color: #f04040;
        }
    }

    @media (max-width: 400px) {
        .rating-container {
            flex-wrap: wrap;
        }
        .rating-star i {
            font-size: 10px;
        }

        .btn-close {
            background-color: #ff6b6b;
            border: none;
            color: white;
            font-size: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close:hover {
            background-color: #f04040;
        }
    }

</style>

@endpush
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <h3><strong>Product Review</strong></h3>
                </div>
                <form action="{{ route('product.review.submit') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div id="product-review-cards">
                        @if ($products->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Your are placed all product review
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="card shadow-lg mb-4 product-card" data-product-id="{{ $product->id }}">
                                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center py-4 shadow">
                                        <h5 class="mb-0">{{ $product->product_name }}</h5>
                                        <button type="button" class="btn btn-outline-danger remove-card" data-product-id="{{ $product->id }}">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
                                        <input type="hidden" name="order_detail_id[]" value="{{ $product->id }}">

                                        <!-- Rating -->
                                        <div class="py-3">
                                            <label for="rating" class="form-label " style="font-size: 20px; color:black; font-family:Garamond">Rate Product</label>
                                            <div class="rating-container d-flex gap-4 ">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" class="btn-check rating-input " name="rating[{{ $product->id }}]" id="rate-{{ $i }}-{{ $product->id }}" value="{{ $i }}">
                                                    <label class="btn btn-outline-warning rating-star " data-rate="{{ $i }}" data-product="{{ $product->id }}" for="rate-{{ $i }}-{{ $product->id }}">
                                                        <i class="fa-solid fa-star"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Review -->
                                        <div class="mb-3">
                                            <label for="review_product" class="form-label" style="font-size: 20px; color:black; font-family:Garamond">Review Product</label>
                                            <textarea name="review_product[{{ $product->id }}]" class="form-control" rows="4" placeholder="Write your review here..."></textarea>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label for="image" class="form-label" style="font-size: 20px; color:black; font-family:Garamond">Upload Product Image</label>
                                            <input type="file" class="form-control" name="image[{{ $product->id }}][]" multiple>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Submit Button -->
                    @if (!$products->isEmpty())
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark rounded-0">Submit Reviews</button>
                        </div>
                    @endif
                </form>

            </div>
        </div>
    </div>

@endsection
@push('js')
    {{-- <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        $(document).ready(function() {
            var counter = 0;
            $('#addIssueBtn').click(function () {
                if($('#items').val() > counter)
                {
                    counter++;
                    var html = `<div class="mb-3 col-md-3">
                                    <label for="" class="form-control-label">Product <span class="text-danger">*</span></label>
                                    <select class="form-control @error('product') is-invalid @enderror" id="issue_product${counter}" name="product_id[]" onchange="getQty(${counter})" required>
                                    <option value="">Select Product</option>
                                        @foreach ($order->order_details as $item)
                                            @if ($item->product->is_replaceable == 1)
                                                <option value="{{$item->id}}">{{$item->product->name_en}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="" class="form-control-label">Issue <span class="text-danger">*</span></label>
                                    <select class="form-control @error('issue') is-invalid @enderror" name="issue[]"  required>
                                        <option value="damaged_product">Damaged Product</option>
                                        <option value="wrong_product">Wrong Product</option>
                                        <option value="incorrect_description">Incorrect Description</option>
                                        <option value="poor_fit_and_size">Poor Fit and Size</option>
                                        <option value="duplicate_order">Duplicate Order</option>
                                    </select>
                                    @error('issue')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label for="" class="form-control-label">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name ="qty[]" class="form-control qty" max="{{$item->qty}}" min="1">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-control-label">Product Images <span class="text-danger">*</span></label>
                                    <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" id="" accept="image/*" required>
                                                </div>
                                    @error('image')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                    @enderror
                                </div>`
                    $('#issues').append(html);
                }
                else{
                    alert('All Products Included')
                }
            });
        });
        let temp = 0;
        function getQty(count) {

            var product_id = $('#issue_product'+count).val();
            // var order_id = $('#order_id').val();
            // alert(product_id);
                var url = '{{ route("get-product-by-id") }}';
                // url = url.replace(':product',product);
                $.ajax({
                    url: url,
                    dataType: 'json',
                    data: {
                        product_id: product_id
                    },
                    beforeSend: function() {
                        // jQuery('select[name=\'branch_district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');
                    },
                    complete: function() {
                        jQuery('.wait').remove();
                    },
                    success: function(data) {
                        var string = data.id.toString();
                        var prev = $('#ordered_product').val();
                        if(!prev){
                            $('#ordered_product').val(string);
                        }
                        else{
                            $('#ordered_product').val($('#ordered_product').val() + ','+ string);
                        }

                    }
                });
        }

    </script> --}}


    <script>
        $('form').on('submit', function (e) {
    var isValid = true;
    var message = "";

    $('.product-card').each(function() {
        var productId = $(this).data('product-id');
        var isRatingSelected = $(this).find('input[name="rating[' + productId + ']"]:checked').length > 0;

        if (!isRatingSelected) {
            isValid = false;
            message = "Please rate all products before submitting.";
            $(this).find('.rating-container').addClass('border border-danger');
        } else {
            $(this).find('.rating-container').removeClass('border border-danger');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert(message);
    }
});
    </script>


    <script>
        $(document).ready(function () {
    $('.rating-input').on('change', function () {
        const productId = $(this).attr('name').match(/\d+/g).join('');
        const selectedRate = parseInt($(this).val());

        $(`.rating-star[data-product="${productId}"]`).each(function () {
            const rate = parseInt($(this).data('rate'));
            if (rate <= selectedRate) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    });
});

    </script>

    <script>
        $(document).ready(function () {
    const $productReviewCards = $('#product-review-cards');

    $productReviewCards.on('click', '.remove-card', function () {
        const productId = $(this).data('product-id');
        const $cardToRemove = $(`.product-card[data-product-id="${productId}"]`);

        if ($cardToRemove.length) {
            $cardToRemove.remove();
        }

        // If all products are removed, disable submit button
        if ($('.product-card').length === 0) {
            $('form button[type="submit"]').prop('disabled', true).text('No products to review');
        }
    });
});

    </script>


@endpush
