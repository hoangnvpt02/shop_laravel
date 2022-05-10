<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserServices
{
    public function create($request) {
        try {
            $request->except('_token');
            User::create([
                'name' => (string) $request->input('name'),
                'username' => (string) $request->input('username'),
                'password' => bcrypt((string) $request->input('password')),
                'phone' => (string) $request->input('phone'),
                'address' => (string) $request->input('address'),
                'gender' => (int) $request->input('gender'),
                'email' => (string) $request->input('email'),
                'role' => 2,
            ]);
            Session::flash('success', 'Tạo Tài khoản thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
}
