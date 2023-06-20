@extends('layouts.app')
@section('content')
@section('title', 'Shops')
<div class="container-fluid p-0 dash-container w-100">
   @include('layouts.header')
   @include('layouts.sidebar')
   <div class="w-100 panel-container">
      <div class="container-fluid max-container container-xxl p-2 p-sm-3 p-md-5 dash-bodies position-relative">
         @include('layouts.loader')
         <div class="dash-body">
            <div class="body-title font-weight-normal h5 mb-2">
               Shops
            </div>
            <div class="w-100 dash-body-container p-3 p-sm-3 p-md-4">
            @include('layouts.alerts')
               <div class="table-container">
                  <table class="table dataTable w-100">
                     <thead>
                        <tr>
                           <th>Shop name</th>
                           <th>Created at</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($shops as $shop)
                        <tr>
                           <td class="first">
                              <a href="#">
                                 <div class="d-flex align-items-center">
                                    <div class="avatar avatar-blue mr-3">{{ $shop->title[0] }}</div>
                                    <div class="">
                                       <p class="font-weight-bold mb-0">{{ $shop->title }}</p>
                                       <p class="text-muted mb-0"><a target="_blank" href="https://{{ $shop->url }}">{{ $shop->url }}</a></p>
                                    </div>
                                 </div>
                              </a>
                           </td>
                           <td data-label="Created at">{{ $shop->created_at->format('d, M Y h:i a') }}</td>
                           <td data-label="Actions">
                              <div class="d-flex table-action">
                                    @if(session('shop_id') == $shop->id)
                                    <a href="#" title="Login" class="d-flex align-items-center login-shop currentShop">Current shop</a>
                                    @else
                                    <a href="{{ route('shops.login', ['shop' => $shop->id]) }}" title="Login" class="d-flex align-items-center login-shop">Login to shop</a>
                                    @endif
                                    <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}"  title="Edit" class="d-flex align-items-center"><i class="m-auto fa-solid fa-square-pen"></i></a>
                                    <a href="{{ route('shops.delete', ['shop' => $shop->id]) }}" title="Delete" class="confirm d-flex align-items-center"><i class="m-auto fa-solid fa-trash-can"></i></a>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                        @if(!$shops->count())
                        <tr>
                            <td colspan="3" class="text-center">No records found.</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
                  <div class="pagination-container mt-4">{!! $shops->render('vendor.pagination.default') !!}</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
@endpush