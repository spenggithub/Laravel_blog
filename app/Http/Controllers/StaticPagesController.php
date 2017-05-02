<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Status;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home(){
        $feed_items = [];
        $max = count(User::all());
        $rand2 = mt_rand(2,$max);
        $rand = mt_rand(2,$max);
        $user_remcom = User::find(1);

        $user_remcom2=User::find($rand);
        $user_remcom3=User::find($rand2);
        if (Auth::check()) {

            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('static_pages/home',compact('feed_items','user_remcom','user_remcom2','user_remcom3'));
    }
    public function about(){
        return view('static_pages/about');
    }
    public function help(){
        return view('static_pages/help');
    }
}
