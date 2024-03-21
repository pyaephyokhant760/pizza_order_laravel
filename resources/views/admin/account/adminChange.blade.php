@extends('admin.layouts.app')

@section('title', 'Details')


@section('contact')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin#listPage')}}">
                                <div>
                                    <i class="fa-solid fa-backward"></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Row</h3>
                            </div>
                            <hr>
                            <form action="{{ route('updata#chage#page',$data->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($data->image == null)
                                            <img src="{{ asset('image/default_image.jpg')}}" alt="John Doe" />
                                        @else
                                            <img src="{{ asset('storage/'.$data->image)}}" alt="John Doe" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image" class="form-control " disabled>
                                            @error('image')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white col-12">Update</button>
                                        </div>
                                    </div>
                                    <div class="row col-6 mt-4">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="name" type="text" class="form-control " value="{{ old('name',$data->name)}}" aria-required="true" aria-invalid="false" placeholder="Enter Name" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" type="text" class="form-control " value="{{ old('email',$data->email)}}" aria-required="true" aria-invalid="false" placeholder="Enter Email" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Phone</label>
                                                <input id="cc-pament" name="phone" type="text" class="form-control " value="{{ old('phone',$data->phone)}}" aria-required="true" aria-invalid="false" placeholder="Enter Phone" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Gender</label>
                                                <select name="gender" class="form-control " disabled>
                                                    <option value="">Choose Gender . . . .</option>
                                                    <option value="male" @if ($data->gender == 'male') selected @endif>Male</option>
                                                    <option value="female" @if ($data->gender == 'female') selected @endif>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Address</label>
                                                <input name="address" class="form-control " placeholder="Enter Address" value="{{ old('address',$data->address)}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                                <select name="role" id="" class="form-control">
                                                    <option value="admin" @if ($data->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user" @if ($data->role == 'user') selected @endif>User</option>
                                                </select>
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
