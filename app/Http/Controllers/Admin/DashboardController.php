<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{

  //

  public function index()
  {
      $usersMonth = User::whereMonth("created_at", Carbon::today()->month)
        ->whereYear("created_at", Carbon::today()->year)
        ->count();

      $usersCount = User::count();

      $revenueMonth = Transaction::where("status", 1)
        ->whereMonth("created_at", Carbon::today()->month)
        ->whereYear("created_at", Carbon::today()->year)
        ->sum("amount");

    $revenueAll = Transaction::where("status", 1)->sum("amount");

    // Biểu đồ người dùng
    $usersArray = [];
    foreach (Last12Months() as $date) {
      $usersArray[$date->format('m/y')] = User::whereMonth("created_at", $date->month)->whereYear("created_at", $date->year)->count();
    }

    // Biểu đồ doanh thu
    $revenueArray = [];
    foreach (Last12Months() as $date) {
      $revenueArray[$date->format('m/y')] = Transaction::where("status", 1)->whereMonth("created_at", $date->month)->whereYear("created_at", $date->year)->sum("amount");
    }

    // Đăng ký mới tháng này
    $newRegister = User::whereMonth("created_at", Carbon::today()->month)->whereYear("created_at", Carbon::today()->year)->orderBy('id', 'desc')->get();

    // Người dùng đăng ký tháng này
    $usersWithTransactions = User::whereHas('transactions', function ($query) {
      $query->where('status', 1);
    })
      ->orderBy("subscribed_time", "desc")
      ->get();

    // Người dùng hoạt động tuần này

    $usersWithProjects = User::whereHas('projects', function ($query) {
      $query
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    })
      ->orderByDesc(DB::raw('(SELECT MAX(created_at) FROM projects WHERE projects.user_id = users.id)'))

      ->get();

    return view("admin.dashboard.index",
      compact('usersMonth', 'usersCount', 'revenueMonth', 'revenueAll', 'usersArray', 'revenueArray', 'newRegister', 'usersWithTransactions', 'usersWithProjects'));
  }
}
