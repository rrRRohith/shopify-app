@extends('layouts.app')
@section('content')
@section('title', 'Login')
<div class="container-fluid p-0 dash-container w-100">
   <div class="w-100 h-100 d-flex align-items-center login-main">
      <div class="login-box w-100 dash-body-container p-3 p-sm-3 m-auto">
         <div class="h4 text-center font-weight-bold">Login to Your Account</div>
         <p class="small text-center">Enter your username & password to login</p>
         @include('layouts.alerts')
         <form method="POST" class="c-form position-relative" action="{{ route('login') }}">
            @csrf
            <div class="row">
               <div class="col-sm-12">
                  <div class="form-group ">
                     <label for="">Email</label>
                     <input type="email" name="email" value="" class="form-control">
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group mb-1">
                     <div class="d-flex"><label class="mr-auto" for="">Password</label> <a class="ml-auto forgot-password" href="#">Forgot password?</a></div>
                     <input type="password" name="password" value="" class="form-control">
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group">
                     <div class="form-check-inline">
                        <input id="option4" type="checkbox" class="form-check-input" value="">
                        <label for="option4" class="form-check-label">Remember me</label>
                     </div>
                  </div>
               </div>
            </div>
            <button class="btn btn-primary w-100 d-block mb-3">Login</button>
         </form>
      </div>
   </div>
</div>
@endsection