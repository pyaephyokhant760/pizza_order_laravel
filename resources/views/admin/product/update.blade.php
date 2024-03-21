@extends('admin.layouts.app')

@section('title', 'Update')


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
                            <form action="{{ route('update#product')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="pizzaId" value="{{ $data->id }}">
                                    <div class="col-4 offset-1">
                                            <img src="{{ asset('storage/'.$data->image)}}" alt="John Doe" />
                                        <div class="mt-3">
                                            <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                            @error('productImage')
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
                                                <input id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" value="{{ old('productName',$data->name)}}" aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                                @error('productName')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Description</label>
                                                <textarea class="form-control @error('productDescription') is-invalid @enderror" name="productDescription">{{ old('productDescription',$data->description)}}</textarea>
                                                @error('productDescription')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Category</label>
                                                <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror">
                                                    <option value="">Choose Gender . . . .</option>
                                                    @foreach ($category as $c)
                                                    <option value="{{$c->id}}" @if ($data->category_id == $c->id) @endif selected>{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('productCategory')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Price</label>
                                                <input id="cc-pament" name="productPrice" type="text" class="form-control @error('productPrice') is-invalid @enderror" value="{{ old('productPrice',$data->price)}}" aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                                @error('productPrice')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Waiting Time</label>
                                                <input id="cc-pament" name="productWatingTime" type="text" class="form-control @error('productWatingTime') is-invalid @enderror" value="{{ old('productWatingTime',$data->waiting_time)}}" aria-required="true" aria-invalid="false">
                                                @error('productWatingTime')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">View Count</label>
                                                <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid @enderror" value="{{ old('created_at',$data->view_count)}}" aria-required="true" aria-invalid="false"  disabled>
                                                @error('role')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Created_at</label>
                                                <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid @enderror" value="{{ old('created_at',$data->created_at->format('j-F-Y'))}}" aria-required="true" aria-invalid="false"  disabled>
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
