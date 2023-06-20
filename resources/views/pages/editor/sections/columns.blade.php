@php
    $section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
    $default_image = asset(Lang::get('placeholder.image'));
    $default_html = Lang::get('placeholder.html');
    $sections = isset($content->sections) ? $content->sections : [1, 2, 3, 4];
    $sectionCount = count($sections);
    $sectionClass = [
            '1' => 'col-md-12',
            '2' => 'col-md-6',
            '3' => 'col-md-4',
            '4' => 'col-md-3',
        ];
    $colClass = $sectionClass[$sectionCount] ?? 'col-md-3';
@endphp
<div class="editor-section position-relative p-4">
<span class="section-divider"><i class="fa-solid fa-grip-vertical"></i> Columns</span>
    <input type="hidden" name="template_contents[{{ $section_id }}][section_type]" value="columns">
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
    <div class="container p-0">
        <div class="row">
            @foreach($sections as $i => $section)
            @php
                $html = isset($section->html_content) ? $section->html_content : null;
                $image = isset($section->image) ? $section->image : null;
                $image_link = isset($section->image_link) ? $section->image_link : null;
            @endphp
            <div class="{{ $colClass }} col-dynamic section-holder mb-3 col__{{ $i }}">
                @if(!isset($content->sections) || (isset($content->sections) && $image))
                <div class="position-relative editor-section image-section">
                    <input type="hidden" name="template_contents[{{ $section_id }}][sections][{{ $i }}][image]" class="image-url" value="{{ $image }}">
                    <input type="hidden" name="template_contents[{{ $section_id }}][sections][{{ $i }}][image_link]" class="image-link" value="{{ $image_link }}">
                    <input type="file" name="" accept="image/*" class="image-uploader d-none v-hidden">
                    <div class="sectionAction sa-2">
                        <span class="section-action remove-col" title="remove"><i
                                class="m-auto fa-solid fa-trash"></i></span>
                    </div>
                    <img src="{{ asset($image ? : $default_image) }}" class="dynamic-image upload-image image-file w-100 cursor-pointer mb-3" alt="">
                </div>
                @endif
                @if(!isset($content->sections) || (isset($content->sections) && $html))
                <div class="position-relative editor-section text-section">
                    <input type="hidden" name="template_contents[{{ $section_id }}][sections][{{ $i }}][html_content]" class="html-content" value="{{ $html }}">
                    <div class="sectionAction sa-2">
                        <span class="section-action remove-col" title="remove"><i
                                class="m-auto fa-solid fa-trash"></i></span>
                    </div>
                    <div class="notebook-editor" contenteditable="true">
                    {!! $html ? : $default_html !!}
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>