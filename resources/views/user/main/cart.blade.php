@extends('user.layouts.master')

@section('contact')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $d)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('storage/'.$d->image)}}" alt="" style="width: 50px;"> {{$d->pizza_name}}</td>
                            <td class="align-middle" id="price">{{$d->pizza_price}} Kyats</td>
                            < <input type="hidden" class="productId" value="{{ $d->product_id}}">
                            < <input type="hidden" class="userId" value="{{ $d->user_id}}">
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                    <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{$d->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $d->pizza_price*$d->qty}} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice + 3000}} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderbtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearbtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
<script>
$(document).ready(function(){

    // when + button click
    $('.btn-plus').click(function(event) {
        $parentNote = $(this).parents('tr');
        $price = Number($parentNote.find('#price').text().replace('Kyats',''));
        $qty = Number($parentNote.find('#qty').val());
        $total = $price * $qty;
        $parentNote.find('#total').html($total+"Kyats");
        summaryCalculation();
    });


    // when - button class
    $('.btn-minus').click(function() {
        $parentNote = $(this).parents('tr');
        $price = Number($parentNote.find('#price').text().replace('Kyats',''));
        $qty = Number($parentNote.find('#qty').val());
        $total = $price * $qty;
        $parentNote.find('#total').html($total+"Kyats");
        summaryCalculation();

    });

    // when crow button class
    $('.btnRemove').click(function() {
        $parentNote = $(this).parents('tr');
        $productId = $parentNote.find('.productId').val();
        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/cartCrow',
            data :{'productId' : $productId},
            dataType : 'json',
        })

        $parentNote.remove();
        summaryCalculation();

    });

    // final calculate price for order
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable   tbody tr').each(function(index,row){
            $totalPrice += $(row).find('#total').text().replace('Kyats','')*1;
        });

        $('#subTotalPrice').html(`${$totalPrice} Kyats`);
        $('#finalPrice').html(`${$totalPrice+3000} Kyats`);

    };

    // order
    $('#orderbtn').click(function() {

        $orderList = [];

        $random = Math.floor(Math.random() * 100000001);

        $('#dataTable tbody tr').each(function(index,row) {
            $orderList.push({
                'user_id' : $(row).find('.userId').val(),
                'product_id' : $(row).find('.productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : $(row).find('#total').text().replace('Kyats','')*1,
                'order_code' : 'POS' + $random
            });
        });
        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/order',
            dataType : 'json',
            data :Object.assign({}, $orderList),
            success : function(response) {
                if(response.status == 'true') {
                    window.location.href = 'http://127.0.0.1:8000/user/home'
                }
            }
        })
    });

    // when clear button click
    $('#clearbtn').click(function() {
        $('#dataTable tbody tr').remove();
        $('#subTotalPrice').html('0 Kyats');
        $('#finalPrice').html('3000 Kyats');

        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/cartClear',
            dataType : 'json',
        })
    })
});
</script>
@endsection
