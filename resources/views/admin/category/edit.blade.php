@extends('admin.layouts.app')

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
                            <h3 class="text-center title-2">Edit Your Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('update#page',$category->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" value="{{ $category->id}}" name="category_id">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="categoryName" type="text" class="form-control @error('categoryName') is-invalid @enderror" value="{{ old('categoryName',$category->name)}}" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
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
