<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
  public function index()
  {
    $cities = City::all();
    return view("admin.cities.index", compact('cities'));
  }

  public function create(Request $request)
  {
    $data = $request->all();
    City::create($data);
    return redirect()->back()->with(["success" => "Tạo thành phố thành công!"]);
  }

  public function edit($id, Request $request)
  {
    $data = $request->all();
    City::find($id)->update($data);
    return redirect()->back()->with(["success" => "Cập nhật thành phố thành công!"]);

  }

  public function delete($id)
  {
    City::find($id)->delete();
    return  response()->json(["status" => 200]);

  }


}
