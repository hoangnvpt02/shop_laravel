@extends('sale.main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/8d4be1a171.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Địa Chỉ</th>
            <th>Ngày Đặt Hàng</th>
            <th>Xác nhận</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $customer->confirm == 0 ? 'Chưa xác nhận' : 'Đã xác nhận' }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" onclick="updateRow({{ $customer->id }}, '/sale/customers/confirm')">
                        <i class="fa-solid fa-check"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/sale/customers/view/{{ $customer->id }}">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="removeRow({{ $customer->id }}, '/sale/customers/destroy')">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $customers->links() !!}
@endsection

