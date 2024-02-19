<?php
namespace App\Services;

use App\Models\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class QrService
{
    public function generateQr($amount, $addInfo): string
    {
        $config = Config::where("name", "bank")->get()->first()->value;
        $bank = json_decode($config, true);
        $bankNumber = $bank["info"];
        $bankName = $bank["name"];
        return "https://img.vietqr.io/image/vcb-$bankNumber-qr_only.jpg?amount=$amount&addInfo=$addInfo&accountName=$bankName";
    }

    public function customQr($bankCode, $accNumber, $amount, $info, $accName)
    {
        return ("https://img.vietqr.io/image/$bankCode-$accNumber-qr_only.jpg?amount=$amount&addInfo=$info&accountName=$accName");
    }
}
