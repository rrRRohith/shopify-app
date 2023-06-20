@extends('layouts.app')
@section('content')
@section('title', 'Dashboard')
<div class="container-fluid p-0 dash-container w-100">
   @include('layouts.header')
   @include('layouts.sidebar')
   <div class="w-100 panel-container">
      <div class="container-fluid max-container container-xxl p-2 p-sm-3 p-md-5 dash-bodies position-relative">
         @include('layouts.loader')
         <div class="dash-body">
            <div class="body-title font-weight-normal h5 mb-2">
               Dashboard
            </div>
            <div class="w-100 dash-body-container p-3 p-sm-3 p-md-4">
               <h4>Welcome {{ auth()->user()->name }}!</h4>
               <p class="mb-0">
               @if(shop())
               Currently logged into shop <span class="font-weight-bold">{{ shop()->title }}</span>, 
               @endif
               Switch to a <a class="font-weight-bold" href="{{ route('shops.index') }}"> shop</a> to manage the store</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush