<?php


namespace App\Services;
use GuzzleHttp\Client;

class BankService
{
  public $username;
  public $password;
  public $clientId = 'iuSuHYVufIUuNIREV0FB9EoLn9kHsDbm';
  public $accessToken;
  public $stk;

  public function __construct($username, $password, $accessToken, $stk)
  {
    $this->username = $username;
    $this->password = $password;
    $this->accessToken = $accessToken;
    $this->stk = $stk;
  }

  public function login()
  {
    $headers = array(
      'Host' => 'apiapp.acb.com.vn',
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/7 CFNetwork/1399 Darwin/22.1.0',
      'apikey' => 'CQk6S5usauGmMgMYLGqCuDtgtqIM8FI1',
      'x-app-version' => '3.13.0',
    );
    $data = array(
      'username' => $this->username,
      'password' => $this->password,
      'clientId' => $this->clientId
    );
    try {
      $login = $this->curl('POST', $data, 'https://apiapp.acb.com.vn/mb/auth/tokens', $headers);
    } catch (\Exception $e) {
      return array(
        'status' => false,
        'message' => 'Cannot login this account!'
      );
    }
    if ($login !== false) {
      if (array_key_exists('accessToken', $login)) {
        $this->accessToken = $login['accessToken'];
        // Set timeout for token;
        $headers['Authorization'] = 'Bearer ' . trim($login['refreshToken']);
        $rfToken = $this->curl('POST', null, 'https://apiapp.acb.com.vn/mb/auth/refresh', $headers);
        $detail = $this->getDetail();
        if ($detail['status']) {
          $cardCode = $detail['data']['data']['0']['accountNumber'];
          $balance = $detail['data']['data']['0']['balance'];
        } else {
          $cardCode = null;
          $balance = 0;
        }
        return array(
          'status' => true,
          'access_token' => $this->accessToken,
          'cardCode' => $cardCode,
          'balance' => $balance
        );
      } else {
        return array(
          'status' => false,
          'message' => 'Cannot login this account!'
        );
      }
    }
    return array(
      'status' => false,
      'message' => 'Connect false!'
    );
  }

  public function history()
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken)
    );
    $count = 0;
    while (true) {
      $history = $this->curl('GET', null, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/account-payment?account=' . $this->stk, $headers);
      if ($history != false) {
        $data = $history;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function getHistory(): ?array
  {
    $login = $this->login();
    if ($login["status"] === true)
    {
      return $this->history();
    }
    return null;
  }

  public function getHistories($from_date, $to_date, $page = 1, $size = 100)
  {
    //from_date và to_date để dạng milisecond int (Unix Timestamp)
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Host' => 'apiapp.acb.com.vn',
      'Accept' => 'application/json, text/plain, */*',
      'Connection' => 'keep-alive',
      'User-Agent' => 'ACB-MBA/3 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Accept-Language' => 'vi',
      'Authorization' => 'Bearer ' . trim($this->accessToken),
      'Accept-Encoding' => 'gzip, deflate, br'
    );
    $count = 0;
    while (true) {
      $dataPost = [
        'account' => $this->stk,
        'transactionType' => 'ALL',
        'from' => $from_date,
        'to' => $to_date,
        'min' => 0,
        'max' => 9007199254740991,
        'page' => $page,
        'size' => $size
      ];
      $history = $this->curl('GET', $dataPost, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/saving/' . $this->stk . '/tx-history', $headers);
      if ($history != false) {
        $data = $history;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }


  public function tranferLimit($receivedBank, $napasBankCode, $tranferTo)
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken)
    );
    $params = array(
      "accountNumber" => $this->username,
      "transferType" => "3",
      "receivedBank" => $receivedBank, // bank bên get tên
      "napasBankCode" => $napasBankCode, // id bank
      "receivedAccountNumber" => $tranferTo, // stk gửi
      "transferTime" => ["type" => 1, "period" => 0, "startDate" => 0, "endDate" => 0],
      "receivedCardNumber" => "",
      "receivedIdCardNumber" => "",
      "receivedPassportNumber" => ""
    );
    $count = 0;
    while (true) {
      $limit = $this->curl('POST', $params, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/transaction-limits', $headers);
      if ($limit != false) {
        $data = $limit;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function tranfer($local, $type, $amount, $partnerName, $name_bank, $comment, $tranferTo, $receivedBank, $napasBankCode, $bySMS, $bySafeKey)
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken)
    );
    $count = 0;
    $params = array(
      "type" => $type,
      "authMethod" => "OTPS",//SMS
      "menu" => "$local",
      "amount" => intval($amount),
      "currency" => "VND",
      "fromAccount" => $this->stk,
      "transactionAmount" => intval($amount),
      "receiverName" => $partnerName, // tên người nhận
      "bankName" => $name_bank,
      "comment" => $comment, // nội dung
      "transferTime" => ["type" => 1, "period" => 0, "startDate" => 0, "endDate" => 0],
      "fee" => 0,
      "resultToEmails" => [],
      "accountInfo" => [
        "accountNumber" => $tranferTo,
        "bankCode" => $receivedBank,
        "bankName" => $name_bank,
        "napasBankCode" => $napasBankCode,
        "bankcheckId" => 0
      ],
      "bankCode" => $receivedBank,
      "napasBankCode" => $napasBankCode,
      "referenceNumber" => "",
      "province" => "",
      "mbTransactionLimitInfo" => [
        "byPass" => 0,
        "bySMS" => $bySMS,
        "byToken" => 0,
        "bySafeKey" => $bySafeKey,
        "byAdvSafeKey" => null
      ]
    );
    while (true) {
      $tranfer = $this->curl('POST', $params, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/submit', $headers);
      if ($tranfer != false) {
        $data = $tranfer;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function confirmTranfer($uuid, $otp)
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json, text/plain, */*',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken),
      'Host' => 'apiapp.acb.com.vn',
      'Connection' => 'keep-alive',
      'Accept-Language' => 'vi',
      'Accept-Encoding' => 'gzip, deflate, br',
      'Cookie' => ''
    );
    $params = array(
      'uuid' => $uuid,
      'code' => $otp,
      'authMethod' => 'OTPS'
    );
    $count = 0;
    while (true) {
      $confirm = $this->curl('POST', $params, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/verify', $headers);
      if ($confirm != false) {
        $data = $confirm;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function getDetail()
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken)
    );
    $count = 0;
    while (true) {
      $detail = $this->curl('GET', null, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/list/account-payment', $headers);
      if ($detail != false) {
        $data = $detail;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function getBankName($tranferTo, $bankCode)
  {
    $status = false;
    $message = 'Error exception';
    $data = array();
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'ACB-MBA/1 CFNetwork/1128.0.1 Darwin/19.6.0',
      'Authorization' => 'Bearer ' . trim($this->accessToken)
    );
    $count = 0;
    while (true) {
      $bankName = $this->curl('GET', null, 'https://apiapp.acb.com.vn/mb/legacy/ss/cs/bankservice/transfers/accounts/' . $tranferTo . '?bankCode=' . $bankCode . '&accountNumber=' . $this->stk, $headers);
      if ($bankName != false) {
        $data = $bankName;
        $status = true;
        $message = 'Successfully';
        break;
      } else {
        $login = $this->login();
      }
      $count++;
      if ($count > 5) {
        $message = 'Connect false';
        break;
      }
    }
    return array(
      'status' => $status,
      'message' => $message,
      'data' => $data
    );
  }

  public function curl($method, $data, $url, $headers)
  {
    $client = new Client();
    $res = $client->request($method, $url, [
      'verify' => true,
      'timeout' => 30,
      'headers' => $headers,
      'body' => json_encode($data),
    ]);
    $body = json_decode($res->getBody()->getContents(), true);
    return $body;
  }
}
