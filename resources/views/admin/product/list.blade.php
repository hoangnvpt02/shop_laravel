@extends('admin.main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/8d4be1a171.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th style="width: 380px">Tên Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Giá gốc</th>
            <th>Giá khuyến mãi</th>
            <th>Số lượng</th>
            <th>Active</th>
            <th>Update</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->menu->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price_sale }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->links() !!}

@endsection

