<?php
namespace App\Services;

class VnPayService
{
  public function createLink($vnp_Returnurl, $vnp_HashSecret, $vnp_TmnCode, $vnp_Amount, $vnp_IpAddr, $vnp_OrderInfo, $vnp_OrderType,
                             $vnp_TxnRef, $vnp_ExpireDate): array
  {
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";


    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => "vn",
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef, // chính là mã GD
      "vnp_ExpireDate" => $vnp_ExpireDate,

    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
      $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    return array(
      'code' => '00',
      'message' => 'success',
      'data' => $vnp_Url
    );


  }
}

?>
