<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  public function __construct()
  {

  }

  function generateNumericOTP($n): string
  {
    $generator = "1357902468";
    $result = "";

    for ($i = 1; $i <= $n; $i++) {
      $result .= substr($generator, (rand() % (strlen($generator))), 1);
    }
    return $result;
  }


  // 1. Check Credentials
  public function checkCredential(Request $request): \Illuminate\Http\JsonResponse
  {
    $phone = $request->get("phone");
    $password = $request->get("password");
    $check = User::where("phone", $phone);
    if ($check->exists()) {
      $employee = $check->first();
      $checkCredential = Hash::check($password, $employee->password);
      if ($checkCredential) {
        return response()->json(["status" => true, "message" => "Đăng nhập thành công!"]);
      } else {
        return response()->json(["status" => false, "message" => "Mật khẩu không đúng!"], 403);
      }
    } else {
      return response()->json(["status" => false, "message" => "Tài khoản không tồn tại!"], 403);
    }
  }

  public function register(Request $request)
  {
    $phone = $request->get("phone");
    $check = User::where("phone", $phone);

    if ($phone == null)
    {
      return response()->json(["status" => false, "message" => "Số điện thoại đang trống!"], 403);

    }

    if (!$check->exists()) {
      // send OTP here
      $pass1 = $request->get("password1");
      $pass2 = $request->get("password2");
      $name = $request->get("name");
      if ($pass2 == $pass1)
      {
        $now = Carbon::now();
        User::create(["phone" => $phone, "name" => $name , "password" => Hash::make($pass1), "subscribed_time" => $now, "role" => 1 , "expired_time" => Carbon::now()->addDays(21)]);
        return response()->json(["status" => true, "message" => "Đăng ký thành công! Vui lòng tiến hành đăng nhập!"]);

      }
      return response()->json(["status" => false, "message" => "Mật khẩu không trùng khớp!"], 403);

    } else {
      return response()->json(["status" => false, "message" => "SĐT đã tồn tại!"], 403);

    }
  }

  // 2. Send OTP
//  public function sendOTP(Request $request)
//  {
//    $phone = $request->get("phone");
//    $check = Employee::where("phone", $phone);
//
//    if ($phone == null)
//    {
//      return response()->json(["status" => false, "message" => "Số điện thoại đang trống!"], 403);
//
//    }
//
//    if ($check->exists()) {
//      // send OTP here
//      $otp = $this->generateNumericOTP(6);
//      $this->ZaloService->sendZNS($request, ["otp" => $otp], $phone, "271979");
//      Employee::where("phone", $phone)->update(["OTP" => $otp, "otp_expire" => Carbon::now()->addMinutes(2)]);
//      return response()->json(["status" => true, "message" => "Mã OTP đã được về số $phone. Mã có tác dụng trong 2 phút. Hãy lưu ý bạn sẽ không nhận được mã từ 22h - 6h."]);
//    } else {
//      return response()->json(["status" => false, "message" => "Tài khoản không tồn tại!"], 403);
//
//    }
//  }
//
//  // 3. Check OTP
//
//  public function checkOTP(Request $request)
//  {
//    $phone = $request->get("phone");
//    $otp = $request->get("otp");
//    $check = Employee::where("phone", $phone);
//
//    if ($check->exists()) {
//      $employee = $check->first();
//      $otpCheck = $employee->OTP;
//      $otpExpire = $employee->otp_expire;
//      if ($otpCheck == $otp) {
//        if (Carbon::now() <= $otpExpire) {
//          Auth::loginUsingId($employee->id, true);
//          return response()->json(["status" => true, "message" => "Đăng nhập thành công!", 'intended_url' => url()->previous()]);
//        } else {
//          return response()->json(["status" => false, "message" => "OTP đã hết hạn. Vui lòng gửi lại."], 500);
//        }
//      } else {
//        return response()->json(["status" => false, "message" => "OTP không chính xác!"], 403);
//      }
//    } else {
//      return response()->json(["status" => false, "message" => "Tài khoản không tồn tại!"], 403);
//    }
//  }

}
