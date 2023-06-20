@php
    $section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
    $html = isset($content->html_content) ? $content->html_content : null;
    $default_image = asset(Lang::get('placeholder.image'));
    $default_html = Lang::get('placeholder.html');
@endphp
<div class="editor-section position-relative p-4 section-holder">
<span class="section-divider"><i class="fa-solid fa-grip-vertical"></i> Product</span>
    <input type="hidden" name="template_contents[{{ $section_id }}][section_type]" value="products">
    <input type="hidden" name="template_contents[{{ $section_id }}][html_content]" class="html-content" value="{{ $html }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][collection]" class="product-collection" value="{{ isset($content->collection) ? $content->collection : null }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][limit]" class="product-limit" value="{{ isset($content->collection) ? $content->limit : null }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][price]" class="product-price" value="{{ isset($content->price) ? $content->price : 0 }}">
    <div class="sectionAction side-action">
        <div class="dropdown">
            <span class="section-action drop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa-solid fa-gears m-auto"></i>
            </span>
            <div class="dropdown-menu p-0 border-0 text-overflow" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="up"><i class="fa-solid fa-arrow-up small"></i> Move up</a>
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="down"><i class="fa-solid fa-arrow-down small"></i> Move down</a>
                <a class="dropdown-item text-overflow remove-section" href="#"><i class="fa-solid fa-trash small"></i> Remove</a>
            </div>
        </div>
    </div>
    <div class="container p-0 position-relative editor-section mb-4">
        <div class="sectionAction sa-2">
            <span class="section-action remove-section" title="remove"><i class="m-auto fa-solid fa-trash"></i></span>
        </div>
        <div class="notebook-editor" contenteditable="true">
            {!! $html ? : $default_html !!}
        </div>
    </div>
    <div class="container p-0">
        <div class="row">
            @for($i = 0; $i < 4; $i++)
            <div class="col-md-3 mb-3">
                <img src="{{ asset('uploads/card.png') }}" class="w-100" alt="">
            </div>
        @endfor
    </div>
</div>
</div>
