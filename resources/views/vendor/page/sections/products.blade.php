@php
$section_id = isset($js) ? '${id}' : (isset($key) ? $key : makeid());
$html = isset($content->html_content) ? $content->html_content : null;
$limit = isset($content->limit) ? $content->limit : 0;
$price = isset($content->price) ? $content->price : 0;
$collection = isset($content->collection) ? $content->collection : all;
@endphp
<div class="indig-container products_{{ $page->id }} section__{{ $key }}" id="indig-page">
    <div class="container m-auto pb-5 pt-5">
        <div class="w-100 mb-5">
            {!! $html !!}
        </div>
        <div class="product-group">
            {% assign collection = collections['{{ $collection }}'] %}
            {%- paginate collection.products by {{ $limit ? : '16' }} -%}
            <div class="row listProducts">
                {%- for product in collection.products  -%}
                {%- assign preview_image = product.featured_media.preview_image -%}
                {%- assign img_url = preview_image | img_url: '400x400' -%}
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <a href="@{{ product.url }}" class="text-decoration-none text-dark">
                        <div class="main_data_block">
                            <div class="product-thumb">
                                <img class="w-100" src="@{{ img_url }}">
                            </div>
                            <div class="mt-2">
                                <div class=""><h5>@{{ product.title | escape  }}</h5></div>
                                @if($price)
                                <div class="">
                                    {% if product.price_varies %}
                                    @{{ product.price_min | money }} - @{{ product.price_max | money }}
                                    {% else %}
                                    @{{ product.price | money }}
                                    {% endif %}
                                </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                {%- endfor -%}
            </div>
        </div>
    </div>
</div>
<div class="pagi">
    @if(!$limit)
        {%- if paginate.pages > 1 -%}
        {% include 'pagination', paginate: paginate %}
        {%- endif -%}
    @endif
    {%- endpaginate -%}
</div>