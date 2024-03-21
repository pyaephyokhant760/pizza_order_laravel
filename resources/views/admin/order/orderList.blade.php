@extends('admin.layouts.app')

@section('title','Product List Page')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="mt-4">
                    <a href="{{ route('orderAdmin#page')}}" class="mb-5"><i class="fa-solid fa-arrow-left me-1"></i>back</a>


                    <div class="row col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-clipboard me-2"></i>Order Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-user me-2"></i>Customer</div>
                                    <div class="col"> {{ strtoupper($userList[0]->user_name)}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col"> {{$userList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                    <div class="col"> {{$userList[0]->created_at->format('F-j-Y')}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"> <i class="fa-solid fa-money-bill-1-wave me-2"></i>Total</div>
                                    <div class="col"> {{$order[0]->total_price}} Kyats</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($userList as $o)
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td class="col-1">{{$o->id }}</td>
                                    <td><img src="{{ asset('storage/'.$o->product_image)}}" class="w-100 h-100"></td>
                                    <td>{{$o->product_name}}</td>
                                    <td class="col-2">{{$o->created_at->format('F-j-Y') }}</td>
                                    <td>{{ $o->qty}}</td>
                                    <td class="col-2">{{$o->total }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

