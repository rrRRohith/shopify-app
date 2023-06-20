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
               <form
                    @isset($page)
                    action="{{ route('pages.update', ['page' => $page->id]) }}"
                    @else
                    action="{{ route('pages.store') }}"
                    @endif
                    class="c-form" method="POST">
                    @csrf
                    @isset($page)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                  <div class="row form-row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="">Page title</label>
                           <input type="text" value="{{ old('title', $page->title ?? null) }}" name="title" required class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="">Page handle <small>(Optional, leave empty to auto generate)</small></label>
                           <div class="page-handler position-relative">
                              <span class="">{{ shop()->domain }}/pages/</span>
                              <input type="text" autocomplete="off" value="{{ old('handle', $page->handle ?? null) }}" name="handle" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="">Status</label>
                            <select name="status" class="form-control">
                            <option value="draft" {{ old('status', $page->status ?? null)  === 'draft' ? 'selected' : null }} >Draft</option>
                            <option value="publish" {{ old('status', $page->status ?? null)  === 'publish' ? 'selected' : null }}>Publish</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="edit-actions">
                     <div class="row m-0 align-items-center">
                     <button class="col-auto btn btn-primary mr-2 mt-2">@isset($page) Update page @else Add new page  @endif</button>
                     @isset($page)<a class="col-auto btn btn-cancel mr-2 mt-2" href="{{ route('pages.show', ['page' => $page->id]) }}">Edit contents</a>
                     <a class="col-auto btn btn-cancel mr-2 mt-2" target="_blank" href="{{ $page->url }}">Preview</a>@endif
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
   $(function(){
      $('.page-handler input').css({
         'padding-left' : $('.page-handler span').width() + 10,
      });
   })
</script>
@endpush