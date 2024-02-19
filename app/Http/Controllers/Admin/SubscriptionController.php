<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
class SubscriptionController extends Controller
{
    //

  protected $transactionService;
  public function __construct()
  {
    $this->transactionService = new TransactionService();
  }


  public function index()
  {
    $transactions = Transaction::orderBy("id", "desc")->get();
    return view("admin.subscriptions.index", compact('transactions'));
  }

  public function confirmTransaction($id)
  {
    $this->transactionService->confrimTransaction($id, "ADMIN XÁC NHẬN TAY");
    return response()->json(["status" => 200]);
  }

  public function deleteTransaction($id)
  {
    Transaction::find($id)->delete();
    return response()->json(["status" => 200]);
  }
}
