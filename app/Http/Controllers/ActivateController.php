<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ActivateController extends Controller
{

  public function activate_user()
  {
    $email = Request::input('email');
    $user  = User::where('email', '=', $email)->get()->first();

    $user->status = "active";
    $user->save();

    return redirect('login')->with('message', 'Account Activated');
  }
}
