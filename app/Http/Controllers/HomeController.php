<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only apply auth middleware to the home dashboard, not the landing page
        $this->middleware('auth')->except('landing');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing()
    {
        $users = [
            ['id' => 1, 'name' => 'Mg Mg'],
            ['id' => 2, 'name' => 'Mya Mya'],
        ];

        return view('myfirst', [
            'users' => $users
        ]);
    }
}
