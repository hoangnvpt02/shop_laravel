@extends('main')

@section('content')
    <div class="container">
        @include('admin.alert')
    </div>
    <section class="shoping-cart spad">
        <form method="POST">
            @if(count($products) != 0)
                <div class="container">
                    @php $total = 0; @endphp
                    <div class="row">
                        <h3 class="pb-4">{{ $title }}</h3>
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        @php
                                            $price = $product->price_sale > 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img style="width: 60px" src="{{ $product->thumb }}" alt="">
                                                <h5>{{ $product->name }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ number_format($price, 0, '', '.') }}đ
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input name="num_product[{{ $product->id }}]" type="number" value="{{ $carts[$product->id] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ number_format($priceEnd, 0, '', '.') }}đ
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="carts/delete/{{ $product->id }}">
                                                    <span class="icon_close"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                <button style="border: none" type="submit" value="Update Cart" formaction="/update-cart" class="primary-btn cart-btn cart-btn-right">Upadate Cart</button>
                                @csrf
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Total <span>{{ number_format($total, 0, '', '.') }}đ</span></li>
                                </ul>
                                <button type="submit" formaction="/carts" class="primary-btn">PROCEED TO CHECKOUT</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center"><h3>Giỏ hàng trống</h3></div>
            @endif
        </form>
    </section>
@endsection
