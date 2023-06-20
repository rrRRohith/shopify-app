@php
$html = isset($content->html_content) ? $content->html_content : null;
@endphp
<div class="indig-container text_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="container m-auto pb-5 pt-5">
        <div class="w-100">
            {!! $html !!}
        </div>
    </div>
</div>