<?php

namespace App\Http\Controllers;

#use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Welcome extends Controller
{
    public function about(){
        return view('pages');
    }

    public function test(){
        $value = Request::header('X-Forwarded-User');
        return $value;
    }
}
