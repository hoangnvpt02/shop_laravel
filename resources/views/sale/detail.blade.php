@extends('sale.main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/8d4be1a171.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="customer">
        @foreach($customers as $key => $customer)
            <ul>
                <li>Tên Khách Hàng: {{ $customer->name }} </li>
                <li>Số Điện Thoại: {{ $customer->phone }} </li>
                <li>Email: {{ $customer->email }}</li>
                <li>Địa Chỉ:{{ $customer->address }} </li>
                <li>Ngày Đặt Hàng: {{ $order_time }}</li>
            </ul>
        @endforeach
        <div class="container">
            @php $total = 0; @endphp
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Img</th>
                                    <th>Price</th>
                                    <th>Quantiy</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                        @php
                                            $price = $order->price_sale > 0 ? $order->price_sale : $order->price;
                                            $priceEnd = $price * $order->quantity;
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td><img style="width: 100px" src="{{$order->thumb}}" alt=""></td>
                                            <td>{{ $price }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $priceEnd }}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">Tổng tiền</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection

