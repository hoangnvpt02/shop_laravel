@extends('main')
@section('content')
    <section class="product-details spad">
        <div class="container">
            @include('admin.alert')
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ $product->thumb }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__price">
                            {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                        </div>
                        <p>
                           {{ $product->description }}
                        </p>
                        <form action="/add-cart" method="POST">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" name="num_product" value="1">
                                    </div>
                                </div>
                            </div>
                            <button style="border: 0" class="primary-btn" type="submit">ADD TO CARD</button>
                            <h6 class="pt-2">{{ $product->quantity }} sản phẩm đang có sẵn</h6>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @csrf
                        </form>

                        <ul>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            @include('product.list')
        </div>
    </section>
@endsection
