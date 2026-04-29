@extends('FrontEnd.master')
@section('title')
    Shopping Cart
@endsection
@section('content')
<div class="container-fluid py-2 page-header">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <input type="hidden" name="" id="cart_products" value="{{count(Cart::content())}}">
                <h2 class="fw-bold">My Cart</h2>
                <!--<h5 class="display-6 fw-semibold">Happy Shopping</h5>-->
                <!--<div class="d-flex justify-content-center mt-3">-->
                <!--    <p class="m-0"><a href="{{route('home')}}">Home</a></p>-->
                <!--    <p class="m-0 px-2">-</p>-->
                <!--    <p class="m-0">Shopping Cart</p>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Cart Information Start -->
<section class="container mb-5 mt-0 pt-0">
    <div class="pt-5">
        <div class="row g-3">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table text-center mb-0">
                    <thead class="text-black">
                        <tr>
                            @if(session()->get('language') == 'bangla')
                            <th>ছবি</th>
                            @else
                            <th>Image</th>
                            @endif
                            @if(session()->get('language') == 'bangla')
                            <th>পণ্য</th>
                            @else
                            <th>Products</th>
                            @endif
                            @if(session()->get('language') == 'bangla')
                            <th>দাম</th>
                            @else
                            <th>Price</th>
                            @endif
                            @if(session()->get('language') == 'bangla')
                            <th>পরিমাণ</th>
                            @else
                            <th>Quantity</th>
                            @endif
                            @if(session()->get('language') == 'bangla')
                            <th>সাবটোটাল</th>
                            @else
                            <th>Subtotal</th>
                            @endif
                            @if(session()->get('language') == 'bangla')
                            <th>অপসারণ</th>
                            @else
                            <th>Remove</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cartPage">

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
{{--                <form class="mb-5" action="#">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control" placeholder="Coupon Code">--}}
{{--                        <div class="ms-2">--}}
{{--                            <button class="btn btn-primary py-2">Apply Coupon</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <div class="card mb-3">
                    <div class="card-header">
                        @if(session()->get('language') == 'bangla')
                        <h4 class="fw-semibold">কার্ট সারাংশ</h4>
                        @else
                        <h4 class="fw-semibold">Cart Summary</h4>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @if(session()->get('language') == 'bangla')
                            <h6 class="fw-semibold">সাবটোটাল</h6>
                            @else
                            <h6 class="fw-semibold">Subtotal</h6>
                            @endif
                            <h6 class="fw-semibold">৳<span id="cartSubTotal"></span></h6>
                        </div>
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <h6 class="fw-semibold">Shipping</h6>--}}
{{--                            <h6 class="fw-semibold">$10</h6>--}}
{{--                        </div>--}}
                        <!--<hr>-->
                        <div class="d-flex justify-content-between my-2" style="display:none !important; ">
                            @if(session()->get('language') == 'bangla')
                            <h5 class="fw-semibold">মোট</h5>
                            @else
                            <h5 class="fw-semibold">Total</h5>
                            @endif
                            <h5 class="fw-semibold" >৳<span id="cartSubTotal"></span></h5>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{route('checkout')}}" class="place_order btn btn-dark btn-lg d-block fw-semibold py-2 px-4">Proceed To
                            Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
        function cart(){
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType:'json',
                success:function(response){
                    console.log(response);
                    var rows = "";
                    // alert(Object.keys(response.carts).length);
                    $('#total_cart_qty').text(Object.keys(response.carts).length);
                    if(Object.keys(response.carts).length > 0){
                        $.each(response.carts, function(key,value){
                            var slug = value.options.slug;
                            var base_url = window.location.origin;
                            rows += `
                            <tr class="pt-30">
                                <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" style="width: 100px; height: 100px" alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="${base_url}/product-details/${slug}">${value.name}</a></h6>`;
                            $.each(value.options.attribute_names, function(index,val){
                                rows +=               `<span>`+val+`: `+value.options.attribute_values[index]+`</span><br/>`;
                            });
                            rows +=       `</td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">৳${Math.round(value.price-value.options.discount)} </h4>
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="align-items-center d-flex justify-content-center">

                                        ${value.qty > 1

                                ? `<button type="submit" style="margin-right: 5px; font-size: 12px;" class="btn btn-sm btn-danger" id="${value.rowId}" onclick="cartDecrement(this.id)" >
                                    <i class="fa fa-minus"></i>
                                    </button>`

                                : `  <button type="submit" style="margin-right: 5px;" class="btn btn-danger btn-sm" disabled > <i class="fa fa-minus"></i>
                                    </button>`

                            }

                                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width: 36px; height:40px; text-align: center; padding-left:0px;">

                                        <button type="submit" style="margin-left: 5px; font-size: 12px; border-radius: 0.25rem" class="btn btn-sm btn-success" id="${value.rowId}" onclick="cartIncrement(this.id)" ><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td class="price text-center" width="100px;" data-title="Price">
                                    <h4 class="text-brand">৳${Math.round(value.subtotal - (value.qty*value.options.discount))} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a  id="${value.rowId}" onclick="cartRemove(this.id)" class="text-body btn btn-danger"><i class="text-white fas fa-trash"></i></a></td>
                            </tr>`;
                        });

                        $('#cartPage').html(rows);

                    }else{
                        html = '<tr><td class="text-center" colspan="6" style="font-size: 18px; font-weight: bold;">Cart empty!</td></tr>';
                        $('#cartPage').html(html);
                    }
                }
            });
        }
        cart();

        /* ==================== Start  cartIncrement ================== */
        function cartIncrement(rowId){
            $.ajax({
                type:'GET',
                url: "/cart-increment/"+rowId,
                dataType:'json',
                success:function(data){
                    // console.log(data)
                    cart();
                    miniCart();

                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })
                    Toast.fire({
                        type:'success',
                        title: data.success
                    })

                    if($.isEmptyObject(data.error)){
                        const Toast = Swal.mixin({
                            toast:true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        Toast.fire({
                            type:'success',
                            title: data.success
                        })

                    }else{
                        const Toast = Swal.mixin({
                            toast:true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        Toast.fire({
                            type:'error',
                            title: data.error
                        })
                    }

                }
            });
        }
        /* ==================== End  cartIncrement ================== */

        /* ==================== Start  Cart Decrement ================== */
        function cartDecrement(rowId){
            $.ajax({
                type:'GET',
                url: "/cart-decrement/"+rowId,
                dataType:'json',
                success:function(data){
                    console.log(data)
                    //console.log(data);
                    // if(data == 2){
                    //     alert("#"+rowId);
                    //     $("#"+rowId).attr("disabled", "true");
                    // }
                    cart();
                    miniCart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }
        /* ================ Start My Cart Remove Product =========== */

        /* ==================== End  Cart Decrement ================== */

        function cartCheck() {
            $.ajax({
                type:'GET',
                url: "/checkout",
                dataType:'json',
                success:function(data){
                    console.log(data.error)
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    })
                    Toast.fire({
                        type:'error',
                        title: data.error
                    })
                }
            });
        }
    </script>
    <script>
        $('.place_order').click(function () {
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })
            if($('#cart_products').val() ==0){
                $('.place_order').prop('disabled', true);
                event.preventDefault();
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: 'Cart is Empty!!'
                })
            }
            else{
                $('.place_order').prop('disabled', false);
            }
        })

    </script>
@endpush
