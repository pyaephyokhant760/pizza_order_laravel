@extends('user.layouts.master')

@section('contact')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control  d-flex align-items-center justify-content-between mb-3 bg-dark p-2">
                        <input type="checkbox" class="custom-control-input " checked id="price-all">
                        <label class="mt-2 text-white" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{ count($category)}}</span>
                    </div>
                    <hr>
                    <div class="custom-control  d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('home#page')}}"> <label class="" for="price-1">All</label></a>
                     </div>
                    @foreach ($category as $c)
                    <div class="custom-control  d-flex align-items-center justify-content-between mb-3">
                       <a href="{{ route('filter#page',$c->id) }}"> <label class="" for="price-1">{{$c->name}}</label></a>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                           <a href="{{ route('cartList#page')}}" class="me-3">
                                <button type="button" class="btn btn-dark position-relative text-white">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{count($cart)}}
                                    <span class="visually-hidden">unread messages</span>
                              </button>
                           </a>
                           <a href="{{ route('history#page')}}">
                            <button type="button" class="btn btn-dark position-relative text-white">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i>History
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($history)}}
                                <span class="visually-hidden">unread messages</span>
                          </button>
                       </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sorting" class='form-control'>
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="des">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="datalist">
                   @if (count($pizza) != 0)
                   @foreach ($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" style="height: 400px" id="myform">
                            <div class="product-item bg-light mb-4" id="myform">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt=""style="height: 230px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('detail#pizza#page',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->price}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                   @else
                        <h2 class="text-danger text-center">No Have</h2>
                   @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection

@section('scriptSource')
<script>
$(document).ready(function(){
    $('#sorting').change(function() {
        $sor = $('#sorting').val();

        if ($sor == 'des') {
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/pizzaList',
                dataType : 'json',
                data :{'status' : 'des'},
                success : function(data) {
                    $list = ``;
                    for ($i = 0; $i < data.length; $i++) {
                            $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" style="height: 400px" id="myform">
                            <div class="product-item bg-light mb-4" id="myform">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${data[$i].image}')}}" alt=""style="height: 230px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data[$i].price}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
                    $('#datalist').html($list);
                }
            })
        } else if($sor == 'asc'){
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/pizzaList',
                dataType : 'json',
                data :{'status' : 'asc'},
                success : function(data) {
                    $list = ``;
                    for ($i = 0; $i < data.length; $i++) {
                            $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" style="height: 400px" id="myform">
                            <div class="product-item bg-light mb-4" id="myform">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${data[$i].image}')}}" alt=""style="height: 230px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data[$i].price}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
                    $('#datalist').html($list);
                }
            })
        }
    })
});

</script>
@endsection
