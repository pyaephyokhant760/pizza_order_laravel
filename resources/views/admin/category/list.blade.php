@extends('admin.layouts.app')

@section('title','Categroy List Page')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1 text-decoration-none">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#page')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
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
                        <form class="form-header" action="{{ route('category#list')}}" method="GET">
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
                    <div class="col-5 my-2">
                        <h3> Total - {{ $categories->total()}}</h3>
                    </div>
                </div>
                @if (count($categories) != 0)
                    <div>
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id}}</td>
                                        <td class="col-5">{{ $category->name}}</td>
                                        <td>{{ $category->created_at->format('j-F-y')}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </button>
                                                <a href="{{ route('edit#page',$category->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('delete',$category->id)}}">
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
                <h3 class="text-secondary text-center mt-5">There is no pizza</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
            {{-- {{ $categories->appends(request()->query())->links()}} --}}
            {{ $categories->links()}}
        </div>
    </div>
</div>
@endsection
