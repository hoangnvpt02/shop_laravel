@extends('main')

@section('content')
    <div class="customer">
        <div class="container mt-6">
            @php $total = 0; @endphp
            <div class="row">
                <div class="col-12">
                    <h4 class="pt-2 pb-3">Chi tiết đơn hàng</h4>
                    <div class="card mt-3 mb-5">
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

