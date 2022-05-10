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
            <th>Tên người dùng</th>
            <th>Tên tài khoản</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Loại tài khoản</th>
            <th>Update</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listUser as $key => $user_)
            <tr>
                <td>{{ $user_->id }}</td>
                <td>{{ $user_->name }}</td>
                <td>{{ $user_->username }}</td>
                <td>{{ $user_->phone }}</td>
                <td>{{ $user_->address }}</td>
                <td>{{ $user_->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                <td>{{ $user_->email }}</td>
                <td>{{ $user_->role }}</td>
                <td>{{ $user_->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/users/edit/{{ $user_->id }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="removeRow({{ $user_->id }}, '/admin/users/destroy')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $listUser->links() !!}

@endsection

