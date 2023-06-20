@php
    $section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
    $html = isset($content->html_content) ? $content->html_content : null;
    $image = isset($content->image) ? $content->image : null;
    $image_link = isset($content->image_link) ? $content->image_link : null;
    $default_image = asset(Lang::get('placeholder.image'));
    $default_html = Lang::get('placeholder.html');
    $first = isset($content->first_item) ? $content->first_item : 'image';
@endphp
<div class="editor-section position-relative p-4 section-holder">
<span class="section-divider"><i class="fa-solid fa-grip-vertical"></i> Text and Image</span>
    <input type="hidden" name="template_contents[{{ $section_id }}][section_type]" value="textImage">
    <input type="hidden" name="template_contents[{{ $section_id }}][html_content]" class="html-content" value="{{ $html }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][image]" class="image-url" value="{{ $image }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][image_link]" class="image-link" value="{{ $image_link }}">
    <input type="hidden" name="template_contents[{{ $section_id }}][first_item]" class="first-item" value="{{ $first }}">
    <input type="file" name="" accept="image/*" class="image-uploader d-none v-hidden">
    <div class="sectionAction side-action">
        <div class="dropdown">
            <span class="section-action drop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa-solid fa-gears m-auto"></i>
            </span>
            <div class="dropdown-menu p-0 border-0 text-overflow" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="up"><i class="fa-solid fa-arrow-up small"></i> Move up</a>
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="down"><i class="fa-solid fa-arrow-down small"></i> Move down</a>
                <a class="dropdown-item text-overflow flip-section" href="#"><i class="fa-solid fa-arrows-turn-to-dots small"></i> Flip position</a>
                <a class="dropdown-item text-overflow remove-section" href="#"><i class="fa-solid fa-trash small"></i> Remove</a>
            </div>
        </div>
    </div>
    <div class="container p-0">
        <div class="row row-flipper">
            @if($first == 'image')
            <div class="col-md-6 flipper mb-3">
                <img src="{{ asset($image ? : $default_image) }}" class="dynamic-image upload-image image-file w-100 cursor-pointer" alt="">
            </div>
            
            <div class="col-md-6 flipper mb-3">
                <div class="notebook-editor" contenteditable="true">
                    {!! $html ? : $default_html !!}
                </div>
            </div>
            @else
            <div class="col-md-6 flipper mb-3">
                <div class="notebook-editor" contenteditable="true">
                    {!! $html ? : $default_html !!}
                </div>
            </div>
            <div class="col-md-6 flipper mb-3">
                <img src="{{ asset($image ? : $default_image) }}" class="dynamic-image upload-image image-file w-100 cursor-pointer" alt="">
            </div>
            @endif
        </div>
    </div>
</div>