<div class="w-100 dash-body-container side-widget">
    <div class="editor-header"><p class="mb-0 h5 text-overflow">{{ $page->title }}</p></div>
    @include('pages.editor.widgets', ['side' => true])
    <div class="d-flex w-100 mt-2">
        <button class="col-auto btn btn-dark w-100 flex-1 text-overflow replacer"> Find and replace </button>
    </div>
    <div class="d-flex w-100 mt-2">
        <button class="col-auto btn btn-primary w-100 save-btn save-side flex-1 text-overflow" form="editor"> Save changes </button>
        <a class="col-auto btn btn-cancel ml-2" target="_blank" href="{{ $page->url }}"><i class="fa-solid fa-eye"></i></a>
    </div>
</div>