@extends('layouts.app')
@section('content')
@section('title', 'Pages | '.shop()->title)
@php
$default = array('rAnDo' => [
'title' => '',
'handle' => '',
'status' => '',
]);
$duplicates = old('pages', $default);
@endphp
<div class="container-fluid p-0 dash-container w-100">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="w-100 panel-container">
        <div class="container-fluid max-container container-xxl p-2 p-sm-3 p-md-5 dash-bodies position-relative">
            @include('layouts.loader')
            <div class="dash-body">
                <div class="body-title font-weight-normal h5 mb-2">
                    Duplicate {{ $page->title }}
                </div>
                <div class="w-100 dash-body-container p-3 p-sm-3 p-md-4">
                    @include('layouts.alerts')
                    <form class="c-form" method="POST" class="duplicator" autocomplete="off">
                        @csrf
                        <div class="duplicate-customizer mb-3">
                            @foreach((array) $duplicates as $key => $duplicate)
                            <div class="dup-container">
                                <div class="row position-relative dup-row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-sm-0">
                                            <input type="text" value="{{ $duplicate['title'] ?? null }}"
                                                name="pages[{{ $key }}][title]" required class="form-control"
                                                placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-sm-0">
                                            <div class="page-handler position-relative">
                                                <span class="">{{ $page->shop->domain }}/pages/</span>
                                                <input type="text" autocomplete="off"
                                                    value="{{ $duplicate['handle'] ?? null }}"
                                                    name="pages[{{ $key }}][handle]" class="form-control"
                                                    placeholder="handle">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-sm-0">
                                            <select name="pages[{{ $key }}][status]" class="form-control">
                                                <option
                                                    {{ ($duplicate['status'] ?? null) == 'draft' ? 'selected' : null }}
                                                    value="draft">Draft</option>
                                                <option
                                                    {{ ($duplicate['status'] ?? null) == 'publish' ? 'selected' : null }}
                                                    value="publish">Publish</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 replacer"><button type="button"
                                            class="btn btn-cancel add-replacer mt-3" data-id="{{ $key }}">Add find and
                                            replace</button></div>
                                </div>
                                <hr>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-cancel add-more">Add more</button>
                        <div class="edit-actions mt-4">
                            <div class="row m-0 align-items-center">
                                <button class="col-auto btn btn-primary mr-2 mt-2">Create duplicates</button>
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
const container = $('.duplicate-customizer');
$('.add-more').on('click', function() {
    newDuplicate();
})
$(document).on('click', '.add-replacer', function() {
    let rid = makeid();
    let id = $(this).attr('data-id');
    $(this).before(`<div class="dup-container replace-holder position-relative mt-3">
        <div class="sectionAction dup-action">
            <span class="section-action drop remove">
            <i class="m-auto fa-solid fa-trash-can"></i>
            </span></div>
            <div class="row position-relative dup-row">
                <div class="col-sm-6">
                    <div class="form-group mb-sm-0">
                        <input type="text" value="" name="pages[${id}][replacer][${rid}][find]" required class="form-control" placeholder="Find what">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-sm-0">
                        <input type="text" value="" name="pages[${id}][replacer][${rid}][replace]" required class="form-control" placeholder="Replace with">
                    </div>
                </div>
            </div><hr>
    </div>`)
});
const newDuplicate = async function(remove = true) {
    let id = makeid();
    let removeEle = '';
    if (remove)
        removeEle = `<div class="sectionAction dup-action">
            <span class="section-action drop remove">
            <i class="m-auto fa-solid fa-trash-can"></i>
            </span></div>`;
    await container.append(`<div class="dup-container position-relative">${removeEle}<div class="row position-relative dup-row">
                     <div class="col-sm-4">
                        <div class="form-group mb-sm-0">
                           <input type="text" value="" name="pages[${id}][title]" required class="form-control" placeholder="Title">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group mb-sm-0">
                           <div class="page-handler position-relative">
                              <span class="">{{ $page->shop->domain }}/pages/</span>
                              <input type="text" autocomplete="off" value="" name="pages[${id}][handle]" class="form-control" placeholder="handle">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-2 ">
                        <div class="form-group mb-sm-0">
                            <select name="pages[${id}][status]" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4 replacer"><button type="button" data-id="${id}" class="btn btn-cancel add-replacer mt-3">Add find and replace</button></div>
                  </div><hr>
                  </div>`);
    updateInput();
}
$(document).on('click', '.remove', function() {
    $(this).closest('.dup-container').remove();
});
const updateInput = function() {
    $('.page-handler').each(function() {
        $(this).find('input').css({
            'padding-left': $(this).find('span').width() + 10,
        });
    });
}
$(function() {
    updateInput();
})
</script>
@endpush