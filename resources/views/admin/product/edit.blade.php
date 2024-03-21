@extends('admin.layouts.app')

@section('title', 'Details')


@section('contact')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                                {{-- <a href="{{ route('list#page')}}" class="text-dark"> --}}
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                {{-- </a> --}}
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class=" col-3 offset-1">
                                        <img src="{{ asset('storage/'.$pizza->image)}}"/>
                                </div>
                                <div class=" col-7 ">
                                    <span class="my-2 btn bg-dark text-white"> <i class="fa-solid fa-file-signature me-2"></i> {{ $pizza->name}}</span>
                                    <span class="my-2 btn bg-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2"></i> {{ $pizza->price}}</span>
                                    <span class="my-2 btn bg-dark text-white"> <i class="fa-solid fa-clock me-2"></i> {{ $pizza->waiting_time}}</span>
                                    <span class="my-2 btn bg-dark text-white"> <i class="fa-solid fa-eye me-2"></i> {{ $pizza->view_count}}</span>
                                    <div class="my-2"> <i class="fa-solid fa-file-lines me-2"></i> {{ $pizza->description}}</div>
                                    <h5 class="my-2"> <i class="fa-solid fa-user-clock me-1"></i> {{ $pizza->created_at->format('j-F-Y')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
