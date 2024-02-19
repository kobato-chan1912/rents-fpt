<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxUpdateController extends Controller
{
    //
    public function update(Request $request)
    {
        $table = $request->get("table");
        $column = $request->get("column");
        $id = $request->get("id");
        $value = $request->get("value");
        DB::table($table)->where("id", $id)->update([$column => $value]);
        return response()->json(["status" => 200]);
    }
}
