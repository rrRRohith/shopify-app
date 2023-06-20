@php
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
<div class="indig-container columns_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="container m-auto pb-5 pt-5">
        <div class="w-100">
            <div class="row">
                @foreach($sections as $i => $section)
                @php
                $html = isset($section->html_content) ? $section->html_content : null;
                $image = isset($section->image) ? $section->image : null;
                $imageLink = isset($section->image_link) ? $section->image_link : null;
                @endphp
                <div class="{{ $colClass }} mb-3 col__{{ $i }}">
                    @if($image)
                        <div class="col-image">
                            @if($imageLink)
                            <a href="{{ $imageLink }}" class="text-decoration-none" target="_blank">
                            @endif
                                <img src="{{ $image }}" class="image-file w-100 cursor-pointer mb-3" alt="">
                            @if($imageLink)
                            </a>
                            @endif
                        </div>
                    @endif
                    @if($html)
                    <div class="col-html">
                        {!! $html !!}
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>