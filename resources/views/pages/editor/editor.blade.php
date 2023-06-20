<div class="dash-body">
    <div class="body-title font-weight-normal h5 mb-2 d-none">
        {{ $page->title }}
    </div>
    <div class="w-100 dash-body-container live-editor">
        @include('layouts.alerts')
        <form action="{{ route('pages.save', ['page' => $page->id]) }}" id="editor" method="POST">
            @csrf
            <div class="editor-container">
                @if($page->template_contents)
                @foreach($page->template_contents as $key => $content)
                @if($content->section_type == 'banner')
                @include('pages.editor.sections.banner')
                @elseif($content->section_type == 'text')
                @include('pages.editor.sections.text')
                @elseif($content->section_type == 'textImage')
                @include('pages.editor.sections.textImage')
                @elseif($content->section_type == 'products')
                @include('pages.editor.sections.products')
                @elseif($content->section_type == 'columns')
                @include('pages.editor.sections.columns')
                @elseif($content->section_type == 'html')
                @include('pages.editor.sections.html')
                @elseif($content->section_type == 'form')
                @include('pages.editor.sections.form')
                @endif
                @endforeach
                @endif
            </div>
            <div class="container-empty p-4">
                <div class="d-flex w-100 add-section-container">
                    <div class="add-section m-auto p-5 cursor-pointer text-center" data-toggle="modal"
                        data-target="#newSectionModal">Click here to add sections</div>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-4 row">
        <div class="edit-actions mr-auto mr-0 col-auto">
            <div class="row m-0 align-items-center">
                <button class="col-auto btn btn-primary mr-2 save-btn mt-2" form="editor"> Save changes </button>
                <a class="col-auto btn btn-cancel mr-2 mt-2" target="_blank" href="{{ $page->url }}">Preview</a>
                <a class="col-auto btn btn-cancel mr-0 mt-2" href="{{ route('pages.index') }}">Back to pages</a>
            </div>
        </div>
    </div>
</div>