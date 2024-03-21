@extends('admin.layouts.app')

@section('title','Categroy List Page')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('data#createPage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" value="{{ old('productName')}}" aria-required="true" aria-invalid="false" placeholder="Enter Your Pizza Name . . .">
                                @error('productName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror">
                                    <option value="">Choose Your Pizza</option>
                                    @foreach ($category as $c )
                                    <option value="{{ $c->id}}">{{ $c->name}}</option>
                                    @endforeach
                                </select>
                                @error('productCategory')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="productDescription" id="" cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror" value="{{ old('productDescription')}}" placeholder="Enter Your Description . . ."></textarea>
                                @error('productDescription')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                @error('productImage')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Wating Time</label>
                                <input type="number" name="productWatingTime" class="form-control @error('productWatingTime') is-invalid @enderror" value="{{ old('productWatingTime')}}">
                                @error('productWatingTime')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="productPrice" type="text" class="form-control @error('productPrice') is-invalid @enderror" value="{{ old('productPrice')}}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price . . .">
                                @error('productPrice')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
