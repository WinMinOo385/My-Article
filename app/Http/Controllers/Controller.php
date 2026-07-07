<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){

        $users = [
            ['id' => 1, 'name' => 'Mg Mg'],
            ['id' => 2, 'name' => 'Mya Mya'],
        ];

        return view('myfirst', [
            'users' => $users
        ]);
    }
}   
