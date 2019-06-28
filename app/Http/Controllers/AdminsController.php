<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminsController extends Controller
{
    public function destroy($id) {
        if(auth()->user()->admin == 1) {
            $user = User::find($id);
            $user->delete();
            return redirect('/dashboard')->with('success','User Removed');
        }
    }
}
