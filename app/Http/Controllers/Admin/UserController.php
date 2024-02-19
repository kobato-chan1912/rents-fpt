<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  //
  public function index()
  {
    $users = User::orderBy("id", "desc")->get();
    return view("admin.users.index", compact('users'));
  }

  public function create(Request $request)
  {
    $email = $request->get("email");
    if (User::where("email", $email)->exists()){
      return redirect()->back()->with(["error" => "Email đã tồn tại!"]);
    }

    $data = $request->all();
    $data["password"] = Hash::make($request->get("password"));
    User::create($data);
    return redirect()->back()->with(["success" => "Tạo người dùng thành công!"]);
  }

  public function delete($id)
  {
    User::find($id)->delete();
    return response()->json(["status" => 200]);
  }

  public function edit($id, Request $request)
  {
    $user = User::find($id);
    $data = $request->all();
    $data["password"] = $request->get("password")==null ? $user->password : Hash::make($request->get("password"));
    $user->update($data);
    return redirect()->back()->with(["success" => "Cập nhật người dùng thành công!"]);

  }
}
