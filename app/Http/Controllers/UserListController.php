<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    //userList
    public function userList() {
        $user = User::where('role','user')->paginate(5);
        return view('admin.user.list',compact('user'));
    }

    // changeRole
    public function changeRole(Request $request) {
        $update = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($update);
    }
}
