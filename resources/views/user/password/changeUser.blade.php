@extends('user.layouts.master')

@section('contact')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('changePage#password')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                @error('oldPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                               @if (session('notMatch'))
                               <small class="invalid-feedback">{{ session('notMatch') }}</small>
                               @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                @error('newPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament" name="comfirmPassword" type="password" class="form-control @error('comfirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Comfirm Password">
                                @error('comfirmPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                    <span id="payment-button-amount text-white">Change Password</span>
                                    <i class="fa-solid fa-lock"></i>
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
