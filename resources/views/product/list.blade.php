<div class="row featured__filter">
    @foreach($products as $key => $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mix">
            <div class="featured__item">
                <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-')}}.html">
                    <div class="featured__item__pic set-bg" data-setbg="{{ $product->thumb }}">
                    </div>
                </a>
                <div class="featured__item__text">
                    <h6><a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-')}}.html">{{ $product->name }}</a></h6>
                    <div>
                        {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
