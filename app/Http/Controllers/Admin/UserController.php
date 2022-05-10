<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Admin\UserServices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function create() {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.user.add', [
            'user' => $user,
            'title' => 'Thêm người dùng'
        ]);
    }

    public function store(UserRequest $request) {
        $this->userServices->insert($request);

        return redirect()->back();
    }

    public function index() {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.user.list', [
            'user' => $user,
            'title' => 'Danh sách người dùng',
            'listUser' => $this->userServices->get()
        ]);
    }

    public function show(User $user_) {
        $user = Auth::user();

        $result = Helper::accountIsAdmin();
        if ($result != false) {
            return $result;
        }

        return view('admin.user.edit', [
            'user' => $user,
            'title' => 'Chỉnh sửa User',
            'user_' => $user_
        ]);
    }

    public function update(Request $request,User $user_)
    {
        $result = $this->userServices->update($request, $user_);
        if ($result) {
            return redirect('/admin/users/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->userServices->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa User thành công'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
