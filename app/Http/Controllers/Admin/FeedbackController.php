<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
  public function index()
  {
    $feedback = Feedback::orderBy("id", "desc")->get();
    return view("admin.feedback.index", compact('feedback'));
  }

  public function updateShow($id, Request $request)
  {
    $feedback = Feedback::find($id);
    $feedback->update(["is_show" => $request->get("is_show")]);
    return response()->json(["status" => 200]);
  }

}
