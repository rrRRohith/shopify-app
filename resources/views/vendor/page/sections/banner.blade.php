@php
$html = isset($content->html_content) ? $content->html_content : null;
$image = isset($content->image) ? $content->image : null;
@endphp
<div class="indig-container banner_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="container-fluid d-flex banner-section d-flex align-items-center pb-5 pt-5 m-auto"
        style="background-image:url({{ $image }})">
        <div class="container w-100 d-flex align-items-center">
            <div class="w-100 pb-5 pt-5">
                {!! $html !!}
            </div>
        </div>
    </div>
</div>