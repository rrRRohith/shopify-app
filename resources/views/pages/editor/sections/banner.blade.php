@php
    $section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
    $html = isset($content->html_content) ? $content->html_content : null;
    $image = isset($content->image) ? $content->image : null;
    $default_image = asset(Lang::get('placeholder.image'));
    $default_html = Lang::get('placeholder.html');
@endphp
<div class="editor-section position-relative p-4 section-holder">
<span class="section-divider"><i class="fa-solid fa-grip-vertical"></i> Banner</span>
    <input type="hidden" name="template_contents[{{ $section_id }}][section_type]" value="banner">
    <input type="hidden" name="template_contents[{{ $section_id }}][html_content]" class="html-content" value="{{ $html }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][image]" class="image-url" value="{{ $image }}">
    <input type="file" name="" accept="image/*" class="image-uploader d-none v-hidden">
    <div class="sectionAction side-action">
        <div class="dropdown">
            <span class="section-action drop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa-solid fa-gears m-auto"></i>
            </span>
            <div class="dropdown-menu p-0 border-0 text-overflow" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="up"><i class="fa-solid fa-arrow-up small"></i> Move up</a>
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="down"><i class="fa-solid fa-arrow-down small"></i> Move down</a>
                <a class="dropdown-item text-overflow upload-image" href="#"><i class="fa-solid fa-image small"></i> Change background</a>
                <a class="dropdown-item text-overflow remove-section" href="#"><i class="fa-solid fa-trash small"></i> Remove</a>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex banner-section d-flex align-items-center p-5 image-file dynamic-image" class="image-file" src="{{ asset($image ? : $default_image) }}" style="background-image:url({{ asset($image ? : $default_image) }})">
        <div class="container w-100">
            <div class="notebook-editor" contenteditable="true">
                {!! $html ? : $default_html !!}
            </div>
        </div>
    </div>
</div>