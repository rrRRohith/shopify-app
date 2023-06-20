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
               <form
                    @isset($shop)
                    action="{{ route('shops.update', ['shop' => $shop->id]) }}"
                    @else
                    action="{{ route('shops.store') }}"
                    @endif
                    class="c-form" method="POST">
                    @csrf
                    @isset($shop)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                  <div class="row form-row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="">Shop name</label>
                           <input type="text" value="{{ old('title', $shop->title ?? null) }}" name="title" required class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                           <label for="">Shop url</label>
                           <input type="text" value="{{ old('url', $shop->url ?? null) }}" name="url" required class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="">API key</label>
                           <input type="text" value="{{ old('api_key', $shop->api_key ?? null) }}" name="api_key" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="">API password</label>
                           <input type="text" value="{{ old('api_password', $shop->api_password ?? null) }}" name="api_password" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="">API version</label>
                            <select name="api_version" class="form-control">
                            <option value="" selected disabled>Select API version</option>
                            @foreach(config('app.shopify_api_versions') as $version)
                                <option {{ old('api_version', $shop->api_version ?? null) === $version ? 'selected' : null }} value="{{ $version }}" class="text-capitalise">{{ $version }}</option>
                            @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                           <label for="">Storefront url</label>
                           <input type="text" value="{{ old('custom_url', $shop->custom_url ?? null) }}" name="custom_url" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="edit-actions">
                     <div class="d-flex align-items-center">
                        <button class="btn btn-primary mr-2">@isset($shop) Update shop @else Add new shop  @endif</button>
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
</script>
@endpush