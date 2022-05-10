@extends('main')

@section('content')
    <div class="customer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="pt-2 pb-3">Danh sách đơn hàng</h4>
                    <div class="card mt-3 mb-5">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Các đơn hàng</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Xác nhận</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listOrders as $key => $orders)
                                    <tr>
                                        <td><a href="order/{{$orders->id}}">Chi tiết đơn hàng</a></td>
                                        <td>{{ $orders->created_at }}</td>
                                        <td>{{ $orders->confirm == 0 ? 'Chưa xác nhận' : 'Đã xác nhận'}}</td>
                                    </tr>
                                @endforeach
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

