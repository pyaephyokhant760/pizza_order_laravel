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
                            <h2 class="title-1 text-decoration-none">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('create#page')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
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
                @if (count($pizza) != 0)
                <div>
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizza as $p)
                            <tr class="tr-shadow">
                                <td class="col-3"><img src="{{ asset('storage/'. $p->image ) }}" class="img-thumbnail"></td>
                                <td class="col-2">{{ $p->product_name}}</td>
                                <td class="col-2">{{ $p->price}}</td>
                                <td class="col-2">{{ $p->category_name}}</td>
                                <td class="col-2">{{ $p->view_count }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('updateProduct#page',$p->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('edit#page#product',$p->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('delete#page',$p->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is no order</h3>
                @endif

                    {{ $pizza->appends(request()->query())->links()}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
