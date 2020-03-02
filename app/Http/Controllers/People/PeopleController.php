<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\People;
use App\User;
use App\Notifications\RegisterPeople;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
  public function index()
  {
    return view('templates.people');
  }

  public function store(Request $request)
  {
    try {
      $people = new People();
      $people->fill($request->all());
      $people->type_people = 'client';
      $people->save();
      $user = new User;
      $user = $user->create([
        'name' => $request->names,
        'email' => $request->email,
        'password' => Hash::make('secret'),
      ]);
      $data_email = ['user' => $user->email, 'password' => 'secret'];
      $user->notify(new RegisterPeople($data_email));
      return ['code' => 200, 'user' => $user];
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $people = People::where('id', $id)->update($request->all());
      // $user = User::where('id', )->update([
      //   'name' => $request->names,
      //   'email' => $request->email,
      // ]);
      return ['code' => 200];
    } catch (\Throwable $th) {
      return $th;
    }
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

  public function delete($id)
  {
    try {
      $data = People::where('id', $id)->delete();
      return ['code' => 200];
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
