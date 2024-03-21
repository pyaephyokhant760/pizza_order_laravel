<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // admin change password page
    public function changePassword() {
        return view('admin.account.changePassword');
    }

    // U password
    public function password(Request $request) {
        $this->validatorCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbpassword = $user->password;
        if (Hash::check($request->oldPassword, $dbpassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
           Auth::logout();
           return redirect()->route('login#page');
        }
        return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
    }

    // Detail
    public function detail() {
        return view('admin.account.details');
    }

    // editAccount
    public function editAccount() {
        return view('admin.account.edit');
    }

    // update
    public function update($id,Request $request) {
        $this->editvalidatorCheck($request);
       $data = $this->getdata($request);

        // for image
        if ($request->hasfile('image')) {
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete(['punlic/', $dbImage]);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }


       User::where('id',$id)->update($data);
       return redirect()->route('detail#page');
    }

    // list page
    public function list() {
        $user = User::when(request('search'),function($query) {
            $query->orWhere('name','like','%'.request('search').'%')
                  ->orWhere('email','like','%'.request('search').'%')
                  ->orWhere('gender','like','%'.request('search').'%')
                  ->orWhere('phone','like','%'.request('search').'%')
                  ->orWhere('address','like','%'.request('search').'%');
        })->where('role','admin')->paginate(3);
        $user->appends(request()->all());
        return view('admin.account.adminList',compact('user'));
    }

    // delete
    public function delete($id) {
        $data = User::where('id',$id)->delete();
        return back();
    }

    // change
    public function change($id) {
        $data = User::where('id',$id)->first();
        return view('admin.account.adminChange',compact('data'));
    }

    // updateAdmin
    public function updateAdmin($id,Request $request) {
        $data = $this->requestData($request);
        User::where('id',$id)->update($data);
        return redirect()->route("admin#listPage");
    }





    //requestData
    private function requestData($request){
        return [
            'role' => $request->role,
        ];
    }

    // getdata
    private function getdata($request) {
       return  [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'gender' => $request->gender,
        'address' => $request->address,
        'updated_at' => Carbon::now()
       ];
    }

    // editvalidatorCheck
    private function editvalidatorCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',

        ])->validate();
    }

    // validatorCheck
    private function validatorCheck($request) {
        Validator::make($request->all(),[
        'oldPassword' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'comfirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
