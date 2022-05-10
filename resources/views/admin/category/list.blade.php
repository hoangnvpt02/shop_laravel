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
            <th>Name</th>
            <th>Description</th>
            <th>Active</th>
            <th>Update</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        {!! \App\Helpers\Helper::category($categorys) !!}
        </tbody>
    </table>
@endsection

