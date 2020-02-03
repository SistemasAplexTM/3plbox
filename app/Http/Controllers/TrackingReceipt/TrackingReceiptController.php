<?php

namespace App\Http\Controllers\TrackingReceipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\

class TrackingReceiptController extends Controller
{
  public function index()
  {
    return view('templates.tracking_receipt');
  }

  public function all()
  {
    try {
      $data = People::where('type_people', 'client')->get();
      return datatables()->of($data)->make(true);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
