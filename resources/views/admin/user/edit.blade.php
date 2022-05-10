@extends('admin.main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên user</label>
                        <input type="text" name="name" value="{{ $user_->name }}" class="form-control"  placeholder="Nhập tên user">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ $user_->username  }}"  class="form-control" placeholder="Username">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value=""  class="form-control" placeholder="Password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Loại tài khoản</label>
                            <select class="form-control" name="role">
                                <option value="1" {{ $user_->role === 1 ? 'selected=""' : ''}}>Admin</option>
                                <option value="2" {{ $user_->role === 2 ? 'selected=""' : ''}}>User</option>
                                <option value="3" {{ $user_->role === 3 ? 'selected=""' : ''}}>Sale</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ $user_->phone }}"  class="form-control" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select class="form-control" name="gender">
                                <option value="1" {{ $user_->gender === 1 ? 'selected=""' : ''}}>Nam</option>
                                <option value="0" {{ $user_->gender === 0 ? 'selected=""' : ''}}>Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="menu">Email</label>
                        <input type="Email" name="email" value="{{ $user_->email }}"  class="form-control" placeholder="Email">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="address" class="form-control" placeholder="Địa chỉ">{{ $user_->address }}</textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Chỉnh sửa User</button>
        </div>
        @csrf
    </form>
@endsection
