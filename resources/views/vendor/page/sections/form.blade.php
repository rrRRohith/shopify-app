@php
$form_html = isset($content->form_content) ? $content->form_content : null;
$form = isset($content->form_elements) ? json_decode($content->form_elements) : [];

$first = isset($content->first_item) ? $content->first_item : 'text';
$image = isset($content->image) ? $content->image : null;
$imageLink = isset($content->image_link) ? $content->image_link : null;
$html = isset($content->html_content) ? $content->html_content : null;
@endphp
<div class="indig-container text_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="mt-5 mb-5">
        <div class="container m-auto pb-5 pt-5 form-page">
            <div class="row">
                @if($first == 'form')
                    <div class="{{ $html || $image ? 'col-sm-6' : 'col-sm-12' }} form-col">
                        <div class="w-100">
                        {!! $form_html !!}
                        </div>
                        <div class="form-container">
                            <form action="" class="indig-form">
                                <input type="hidden" class="form-element" value='@json($form ?: [])'>
                                <div class="form-elements">

                                </div>
                            </form>
                        </div>
                    </div>
                    @if($image)
                    <div class="col-sm-6 col-image">
                        @if($imageLink)
                            <a href="{{ $imageLink }}" class="text-decoration-none" target="_blank">
                        @endif
                            <img src="{{ $image }}" class="image-file w-100 cursor-pointer mb-3" alt="">
                        @if($imageLink)
                            </a>
                        @endif
                    </div>
                    @endif
                    @if(isset($js) || $html)
                    <div class="col-sm-6 col-text">
                        {!! $html !!}
                    </div>
                    @endif
                @else
                    @if($image)
                    <div class="col-sm-6 col-image">
                        @if($imageLink)
                            <a href="{{ $imageLink }}" class="text-decoration-none" target="_blank">
                        @endif
                            <img src="{{ $image }}" class="image-file w-100 cursor-pointer mb-3" alt="">
                        @if($imageLink)
                            </a>
                        @endif
                    </div>
                    @endif
                    @if(isset($js) || $html)
                    <div class="col-sm-6 col-text">
                        {!! $html !!}
                    </div>
                    @endif
                    <div class="{{ $html || $image ? 'col-sm-6' : 'col-sm-12' }} form-col">
                        <div class="w-100">
                        {!! $form_html !!}
                        </div>
                        <div class="form-container">
                            <form action="" class="indig-form">
                                <input type="hidden" class="form-element" value='@json($form ?: [])'>
                                <div class="form-elements">

                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
