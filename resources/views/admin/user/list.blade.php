@extends('admin.layouts.app')

@section('title','Product List Page')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
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
                        <div class="table-data__tool-right pt-5">
                        <a href="">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add User
                            </button>
                        </a>
                       
                    </div>
                    </div>
                    
                </div>
                {{-- total show --}}
                <div class="row">
                    <div class="col-5 my-3">
                        <h4 class="text-danger"></h4>
                    </div>
                </div>
                <div class="mt-4">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($user as $u)
                            <tr>
                                <td class="col-2">
                                    @if ($u->image == null)
                                        <img src="{{ asset('image/default_image.jpg')}}" class="img-thumbnail"  style="height: 10px,width: 50px"/>
                                    @else
                                        <img src="{{ asset('storage/'.$u->image)}}"  class="img-thumbnail"  style="height: 10px,width: 50px"/>
                                    @endif
                                </td>
                                <input type="hidden" id="userId" value="{{ $u->id}}">
                                <td col-2>{{ $u->name}}</td>
                                <td class="col-2">{{ $u->email}}</td>
                                <td class="col-1">{{ $u->gender}}</td>
                                <td class="col-1">{{ $u->phone}}</td>
                                <td class="col-1">{{ $u->address}}</td>
                                <td class="col-3">
                                    <select name="" id="" class="form-control statusChange" col-12>
                                        <option value="user" @if($u->role == 'user') selected @endif>User</option>
                                        <option value="admin" @if($u->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    {{-- {{ $pizza->appends(request()->query())->links()}} --}}
                    <div class="mt-5">
                        {{$user->links()}}
                    </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSection')
<script>
    $(document).ready(function(){
        // change status
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').val();
            console.log($userId);
            $data = {'userId' : $userId,'role' : $currentStatus}
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/change/role',
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
