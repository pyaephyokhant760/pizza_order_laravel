@extends('user.layouts.master')

@section('contact')

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$data->image)}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">

                <div class="h-100 bg-light p-30">
                    <input type="hidden" value="{{ Auth::user()->id}}" id="userId">
                    <input type="hidden" value="{{$data->id}}" id="pizzaId">
                    <h3>{{$data->name}}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{ $data->view_count +1}} <i class="fa-solid fa-eye"></i></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$data->price}} Kyats</h3>
                    <p class="mb-4">{{$data->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1" id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->




    <!-- Products End -->



@endsection
@section('scriptSource')
<script>
$(document).ready(function(){

    // increase view count
    $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/increase/viewCount',
                dataType : 'json',
                data :{ 'productId' : $('#pizzaId').val()}
        });



    // click add to cart btn
    $('#addCartBtn').click(function() {
        $source = {
                'userId' : $('#userId').val(),
                'pizzaId' : $('#pizzaId').val(),
                'count' : $('#orderCount').val()
        }
        $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/cart',
                dataType : 'json',
                data :$source,
                success : function (respon) {
                    if (respon.status == 'Success') {
                        window.location.href = 'http://127.0.0.1:8000/user/home'
                    }
                }
        });
    })
});

</script>
@endsection

