@extends('layouts.app')
@section('content')
@section('title', 'Pages | '.shop()->title)
<div class="container-fluid p-0 dash-container w-100">
   @include('layouts.header')
   @include('layouts.sidebar')
   <div class="w-100 panel-container">
      <div class="container-fluid max-container container-xxl p-2 p-sm-3 p-md-5 dash-bodies position-relative">
         @include('layouts.loader')
         <div class="dash-body">
            <div class="body-title font-weight-normal h5 mb-2">
               Pages of {{ shop()->title }}
            </div>
            <div class="w-100 dash-body-container p-3 p-sm-3 p-md-4">
            @include('layouts.alerts')
               <div class="table-container">
                  <table class="table dataTable w-100">
                     <thead>
                        <tr>
                           <th>Title</th>
                           <th>Created at</th>
                           <th>Visibility</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($pages as $page)
                        <tr>
                           <td class="first">
                              <a href="#">
                                 <div class="d-flex align-items-center">
                                    <div class="avatar avatar-blue mr-3">{{ $page->title[0] }}</div>
                                    <div class="">
                                       <p class="font-weight-bold mb-0">{{ $page->title }}</p>
                                    </div>
                                 </div>
                              </a>
                           </td>
                           <td data-label="Created at">{{ $page->created_at->format('d, M Y h:i a') }}</td>
                           <td data-label="Visibility">
                              <div class="badge badge-success badge-success-alt {{ $page->status }} text-capitalize">{{ $page->status }}</div>
                           </td>
                           <td data-label="Actions">
                              <div class="d-flex table-action">
                                    <a href="{{ route('pages.duplicate', ['page' => $page->id]) }}" data-title="{{ $page->title }}" title="Duplicate" class="d-flex align-items-center duplicate-pages"><i class="m-auto fa-solid fa-clone"></i></a>
                                    <a href="{{ route('pages.show', ['page' => $page->id]) }}" title="Live edit" class="d-flex align-items-center"><i class="m-auto fa-solid fa-palette"></i></a>
                                    <a href="{{ route('pages.edit', ['page' => $page->id]) }}" title="Edit" class="d-flex align-items-center"><i class="m-auto fa-solid fa-square-pen"></i></a>
                                    <a href="{{ route('pages.delete', ['page' => $page->id]) }}" title="Delete" class="confirm d-flex align-items-center"><i class="m-auto fa-solid fa-trash-can"></i></a>
                                    <a href="{{ $page->url }}" target="_blank" title="View" class="d-flex align-items-center login-shop currentShop">View</a>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                        @if(!$pages->count())
                        <tr>
                            <td colspan="4" class="text-center">No records found.</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
                  <div class="pagination-container mt-4">{!! $pages->render('vendor.pagination.default') !!}</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
