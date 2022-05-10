<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{

    public function index() {
        $user = Auth::user();
        $result = Helper::accountIsAdmin();
        if ($result != false) {
             return $result;
        }

        return view('admin.home', [
            'title' => 'Trang quản trị Admin',
            'user' => $user
        ]);
    }
}
