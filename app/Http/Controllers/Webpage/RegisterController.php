<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
  public function index()
  {
    return view("register");
  }

  public function register(Request $request)
  {
    $email = $request->get("email");
    $password = $request->get("password");
    $confirmPassword = $request->get("confirm_password");

    $user = User::where("email", $email);
    if ($user->exists()){
      return redirect()->back()->with(["error" => "Tài khoản đã tồn tại"]);
    }

    if ($password !== $confirmPassword){
      return redirect()->back()->with(["error" => "Mật khẩu xác nhận không đúng"]);
    }

    User::create(["email" => $email, "name" => $request->get("email"),
      "password" => Hash::make($password), "role" => $request->get("role")]);

    return redirect("/login")->with(["success" => "Bạn đã đăng ký thành công. Vui lòng đăng nhập."]);

  }
}
