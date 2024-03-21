@extends('admin.layouts.app')

@section('title','Product List Page')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1 text-decoration-none">Order List</h2>

                        </div>
                    </div>
                </div>

                {{-- create success --}}
                @if (session('categorySuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i>{{ session('categorySuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                {{-- delete success --}}
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i>{{ session('deleteSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                {{-- search box --}}
                <div class="row">
                    <div class="col-3 row">
                        <h5 class="text-secondary">Search Key : <span class="text-danger">{{ request('search')}}</span></h5>
                    </div>
                    <div class="col-4 offset-4 my-2 mb-3">
                        <form class="form-header" action="{{ route('list#page')}}" method="GET">
                            @csrf
                            <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." value="{{ request('search')}}"/>
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                {{-- total show --}}
                <div class="row">
                    <div class="col-5 my-3">
                        <h4 class="text-danger"></h4>
                    </div>
                </div>
                <form action="{{ route('status#page')}}" method="get">
                    @csrf
                    <div class="d-flex">
                        <label for="" class="mt-1 me-4">Order Status</label>
                        <select name="orderStatus" class="form-control col-2">
                            <option value="all" >All</option>
                            <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <button class="btn sm bg-dark text-white" type="submit">Search</button>
                    </div>
                </form>
                <div class="mt-4">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                                <tr class="tr-shadow">
                                    <input type="hidden" value="{{ $o->id }}" class="orderId">
                                    <td class="col-1">{{$o->id }}</td>
                                    <td class="col-2">{{$o->user_name }}</td>
                                    <td class="col-2">{{$o->created_at->format('F-j-Y') }}</td>
                                    <td class="col-2">
                                        <a href="{{ route('listInfo#page',$o->order_code)}}">{{$o->order_code}}</a>
                                    </td>
                                    <td class="col-2 amount">{{$o->total_price }}</td>
                                    <td class="col-2">
                                        <select name="status" class="form-control statusChange">
                                            <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    {{-- {{ $pizza->appends(request()->query())->links()}} --}}
                    {{-- {{$order->links()}} --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        // $('#status').change(function() {
        //     $status = $('#status').val();
        //     $.ajax({
        //         type : 'get',
        //         url : 'http://127.0.0.1:8000/order/ajax/status',
        //         dataType : 'json',
        //         data :{'status' : $status},
        //         success : function(data) {
        //             $list = ``;
        //             for ($i = 0; $i < data.length; $i++) {
        //                 $months = ['January','February','March','Apiral','May','June','July','Auguest','September','October','November','December'];
        //                 $dbDate = new Date(data[$i].created_at);
        //                 $finalDate = $months[$dbDate.getMonth()] +'-'+ $dbDate.getDate()+'-'+ $dbDate.getFullYear()

        //                 if (data[$i].status == 0) {
        //                     $statusMessage = `
        //                     <select name="status" class="form-control ">
        //                         <option value="0" selected>Pending</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" >Reject</option>
        //                     </select>
        //                     `;
        //                 }else if(data[$i].status == 1){
        //                     $statusMessage = `
        //                     <select name="status" class="form-control ">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" selected>Accept</option>
        //                         <option value="2" >Reject</option>
        //                     </select>
        //                     `;
        //                 }else if(data[$i].status == 2) {
        //                     $statusMessage = `
        //                     <select name="status" class="form-control ">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" selected>Reject</option>
        //                     </select>
        //                     `;
        //                 }
        //                     $list +=
        //                     `<tr class="tr-shadow">
        //                         <td class="col-1">${data[$i].id}</td>
        //                         <td class="col-2">${data[$i].user_name}</td>
        //                         <td class="col-2">${$finalDate}</td>
        //                         <td class="col-2">${data[$i].order_code}</td>
        //                         <td class="col-2">${data[$i].total_price}</td>
        //                         <td class="col-2">${$statusMessage}</td>
        //                     </tr>`
        //             }
        //             // console.log($list);
        //             $('#dataList').html($list);
        //         }
        //     });
        // });
        // change status
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();

            $data = {
                'status' : $currentStatus,
                'orderId' : $orderId
            }
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/order/ajax/change/status',
                dataType : 'json',
                data : $data,
                success : function(data) {

                }
            });
            location.reload();
        });
    });
</script>
@endsection
