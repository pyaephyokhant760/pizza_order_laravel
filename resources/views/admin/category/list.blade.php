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
                            <h2 class="title-1">Category List</h2>

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

                {{-- Search box --}}
                                <tr class="tr-shadow">
                                    <td>{{ $category->category_id}}</td>
                                    <td class="col-5">{{ $category->name}}</td>
                                    <td>{{ $category->created_at->format('j-F-y')}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                           <a href="{{ route('delete',$category->category_id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                           </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links()}}
                </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is no order</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
