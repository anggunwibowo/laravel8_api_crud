<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\UserTest;

class HomeController extends Controller
{
    public function index()
    {
     
        $data = User::select('name','email','status','position')
        		  ->leftJoin("user_test", 'user_test.user_id', '=', "users.id")
        		  ->paginate(10);

        return view('home', array('data' => $data));
    }
}
