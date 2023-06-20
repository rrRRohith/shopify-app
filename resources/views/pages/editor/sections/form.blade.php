@php
    $section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
    $form = isset($content->form_elements) ? json_decode($content->form_elements) : null;
    $default_form = Lang::get('placeholder.form');
    $form_html = isset($content->form_content) ? $content->form_content : null;
    $form_default_html = Lang::get('placeholder.heading');
    $first = isset($content->first_item) ? $content->first_item : 'text';
    $image = isset($content->image) ? $content->image : null;
    $image_link = isset($content->image_link) ? $content->image_link : null;
    $default_image = asset(Lang::get('placeholder.image'));

    $html = isset($content->html_content) ? $content->html_content : null;
    $default_html = Lang::get('placeholder.html');
@endphp
<div class="editor-section position-relative p-4 section-holder">
    <span class="section-divider"><i class="fa-solid fa-grip-vertical"></i> Form</span>
    <input type="hidden" name="template_contents[{{ $section_id }}][section_type]" value="form">
    <input type="hidden" name="template_contents[{{ $section_id }}][first_item]" class="first-item" value="{{ $first }}">
    <div class="sectionAction side-action">
        <div class="editor-actions">
            <a href="#" class="btn btn-dark new-element mr-2 btn-sm">New field</a>
            <a href="#" class="btn btn-primary save-form mr-2 btn-sm close-edit">Save</a>
        </div>
        <div class="dropdown">
            <span class="section-action drop" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true">
                <i class="fa-solid fa-gears m-auto"></i>
            </span>
            <div class="dropdown-menu p-0 border-0 text-overflow" aria-labelledby="dropdownMenuButton"
                x-placement="bottom-start">
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="up"><i
                        class="fa-solid fa-arrow-up small"></i> Move up</a>
                <a class="dropdown-item text-overflow move-section" href="#" data-direction="down"><i
                        class="fa-solid fa-arrow-down small"></i> Move down</a>
                @if($html || $image || isset($js))
                <a class="dropdown-item text-overflow flip-section-form" href="#"><i class="fa-solid fa-arrows-turn-to-dots small"></i> Flip position</a>
                @endif
                <a class="dropdown-item text-overflow update-form" href="#"><i class="fa-brands fa-wpforms"></i> Edit
                    form</a>
                <a class="dropdown-item text-overflow remove-section" href="#"><i class="fa-solid fa-trash small"></i>
                    Remove</a>
            </div>
        </div>
    </div>
    <div class="row row-flipper">
        @if($first == 'form')
        <div class="{{ $html || $image ? 'col-sm-6' : 'col-sm-12' }} flipper form-col">
            <div class="container p-0 formCONTAINER editor-section section-holder">
                <input type="hidden" name="template_contents[{{ $section_id }}][form_content]" class="html-content" value="{{ $form_html }}">
                <input type="hidden" name="template_contents[{{ $section_id }}][form_elements]" class="form-element" value='@json($form ?: $default_form)'>
                <div class="notebook-editor" contenteditable="true">
                    {!! $form_html ? : $form_default_html !!}
                </div>
                <div class="form-editor-container mt-0 position-relative form__{{ $section_id }}">
                    <div class="form-editor"></div>
                    <div class="empty__form" style="display:none">Add fields to form</div>
                </div>
            </div>
        </div>
        @if(isset($js) || $image)
        <div class="col-sm-6 flipper image-col mb-3 editor-section">
            <input type="hidden" name="template_contents[{{ $section_id }}][image]" class="image-url" value="{{ $image }}">
            <input type="hidden" name="template_contents[{{ $section_id }}][image_link]" class="image-link" value="{{ $image_link }}">
            <input type="file" name="" accept="image/*" class="image-uploader d-none v-hidden">
            <img src="{{ asset($image ? : $default_image) }}" class="dynamic-image upload-image image-file w-100 cursor-pointer mb-3" alt="">
        </div>
        @endif
        @if(isset($js) || $html)
        <div class="col-sm-6  flipper text-col mb-3 editor-section section-holder">
            <input type="hidden" name="template_contents[{{ $section_id }}][html_content]" class="html-content" value="{{ $html }}">
            <div class="notebook-editor" contenteditable="true">
                {!! $html ? : $default_html !!}
            </div>
        </div>
        @endif
        @else
        @if(isset($js) || $image)
        <div class="col-sm-6 flipper image-col mb-3 editor-section">
            <input type="hidden" name="template_contents[{{ $section_id }}][image]" class="image-url" value="{{ $image }}">
            <input type="hidden" name="template_contents[{{ $section_id }}][image_link]" class="image-link" value="{{ $image_link }}">
            <input type="file" name="" accept="image/*" class="image-uploader d-none v-hidden">
            <img src="{{ asset($image ? : $default_image) }}" class="dynamic-image upload-image image-file w-100 cursor-pointer mb-3" alt="">
        </div>
        @endif
        @if(isset($js) || $html)
        <div class="col-sm-6  flipper text-col mb-3 editor-section section-holder">
            <input type="hidden" name="template_contents[{{ $section_id }}][html_content]" class="html-content" value="{{ $html }}">
            <div class="notebook-editor" contenteditable="true">
                {!! $html ? : $default_html !!}
            </div>
        </div>
        @endif
        <div class="{{ $html || $image ? 'col-sm-6' : 'col-sm-12' }} flipper form-col">
            <div class="container p-0 formCONTAINER editor-section section-holder">
                <input type="hidden" name="template_contents[{{ $section_id }}][form_content]" class="html-content" value="{{ $form_html }}">
                <input type="hidden" name="template_contents[{{ $section_id }}][form_elements]" class="form-element" value='@json($form ?: $default_form)'>
                <div class="notebook-editor" contenteditable="true">
                    {!! $form_html ? : $form_default_html !!}
                </div>
                <div class="form-editor-container mt-0 position-relative form__{{ $section_id }}">
                    <div class="form-editor"></div>
                    <div class="empty__form" style="display:none">Add fields to form</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>