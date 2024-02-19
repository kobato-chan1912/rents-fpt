<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
  public function index()
  {
    $packages = Package::all();
    return view("admin.packages.index", compact('packages'));
  }

  public function create(Request $request)
  {
    Package::create($request->all());
    return redirect()->back()->with(["success" => "Tạo gói thành công!"]);
  }

  public function edit($id, Request $request)
  {
    Package::find($id)->update($request->all());
    return redirect()->back()->with(["success" => "Cập nhật gói thành công!"]);

  }

  public function delete($id)
  {
    Package::find($id)->delete();
    return response()->json(["status" => 200]);

  }
}
