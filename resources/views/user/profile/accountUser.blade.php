@extends('user.layouts.master')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>
                        <form action="{{ route('change#account#page',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_image.jpg')}}" alt="John Doe" style="height: 300px;width: 300px"/>
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image)}}" alt="John Doe" style="height: 300px;width: 300px"/>
                                    @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-dark text-white col-12">Update</button>
                                    </div>
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row col-6 mt-4">
                                    <div class="">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name)}}" aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email)}}" aria-required="true" aria-invalid="false" placeholder="Enter Email">
                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',Auth::user()->phone)}}" aria-required="true" aria-invalid="false" placeholder="Enter Phone">
                                            @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender . . . .</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address">{{ old('address',Auth::user()->address)}}</textarea>
                                            @error('address')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid @enderror" value="{{ old('role',Auth::user()->role)}}" aria-required="true" aria-invalid="false"  disabled>
                                            @error('role')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
