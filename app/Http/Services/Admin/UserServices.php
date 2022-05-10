<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserServices
{
    public function insert($request) {
        try {
            $request->except('_token');
            User::create([
                'name' => (string) $request->input('name'),
                'username' => (string) $request->input('username'),
                'password' => bcrypt((string) $request->input('password')),
                'role' => (int) $request->input('role'),
                'phone' => (string) $request->input('phone'),
                'gender' => (int) $request->input('gender'),
                'email' => (string) $request->input('email'),
                'address' => (string) $request->input('address')
            ]);

            Session::flash('success', 'Thêm User thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm User lỗi');
            \Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }

    public function get() {
        return User::orderBy('id')->paginate('10');
    }

    public function update($request, $user) {
        try {
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->name = $request->name;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if ($user) {
            try {
                $user->delete();
            } catch (\Exception $err) {
                return false;
            }
            return true;
        }

        return false;
    }
}
