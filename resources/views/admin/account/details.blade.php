@extends('admin.layouts.app')

@section('title', 'Details')


@section('contact')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class=" col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_image.jpg')}}" alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/'. Auth::user()->image)}}" alt="John Doe" />
                                    @endif
                                </div>
                                <div class=" col-7 offset-1">
                                    <h5 class="my-2"> <i class="fa-solid fa-file-signature me-1"></i> {{ Auth::user()->name}}</h5>
                                    <h5 class="my-2"> <i class="fa-solid fa-envelope me-1"></i> {{ Auth::user()->email}}</h5>
                                    <h5 class="my-2"> <i class="fa-solid fa-phone me-1"></i> {{ Auth::user()->phone}}</h5>
                                    <h5 class="my-2"> <i class="fa-solid fa-location-arrow me-1"></i> {{ Auth::user()->address}}</h5>
                                    <h5 class="my-2"> <i class="fa-solid fa-person-half-dress"></i> {{ Auth::user()->gender}}</h5>
                                    <h5 class="my-2"> <i class="fa-solid fa-user-clock me-1"></i> {{ Auth::user()->created_at->format('j-F-Y')}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-4 mt-3">
                                    <a href="{{ route('edit#page#account') }}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
