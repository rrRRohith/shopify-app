@php
$html = isset($content->html_content) ? $content->html_content : null;
$image = isset($content->image) ? $content->image : null;
$imageLink = isset($content->image_link) ? $content->image_link : null;
$first = isset($content->first_item) ? $content->first_item : 'image';
@endphp
<div class="indig-container textImage_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="container m-auto pb-5 pt-5">
        <div class="w-100">
            <div class="row">
                @if($first == 'image')
                <div class="col-md-6 mb-3 col-image">
                    @if($imageLink)
                    <a href="{{ $imageLink }}" class="text-decoration-none" target="_blank">
                    @endif
                        <img src="{{ $image }}" class="image-file w-100 cursor-pointer" alt="">
                    @if($imageLink)
                    </a>
                    @endif
                </div>
                <div class="col-md-6 mb-3 col-html">
                    {!! $html !!}
                </div>
                @else
                <div class="col-md-6 mb-3 col-html">
                    {!! $html !!}
                </div>
                <div class="col-md-6 mb-3 col-image">
                    @if($imageLink)
                    <a href="{{ $imageLink }}" class="text-decoration-none" target="_blank">
                    @endif
                        <img src="{{ $image }}" class="image-file w-100 cursor-pointer" alt="">
                    @if($imageLink)
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>