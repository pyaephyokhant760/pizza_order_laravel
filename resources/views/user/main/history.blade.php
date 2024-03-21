@extends('user.layouts.master')

@section('contact')
    <!-- Breadcrumb Start -->
    <div class="container-fluid" >
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
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 offset-2">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th></th>

                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle" id="">{{$o->created_at->format('F-j-Y')}}</td>
                            <td class="align-middle" id="">{{$o->order_code}}</td>
                            <td class="align-middle" id="">{{$o->total_price}}</td>
                            <td class="align-middle" id="">{{$o->status}}</td>
                            <td class="align-middle" id="">
                                @if ($o->status == 0)
                                    <span class="text-warning shawdow-sm"><i class="fa-solid fa-hourglass-start me-1"></i>Pending..</span>
                                @elseif($o->status == 1)
                                    <span class="text-success shawdow-sm"><i class="fa-solid fa-check me-2"></i>Success</span>
                                @elseif($o->status == 2)
                                    <span class="text-danger shawdow-sm"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
