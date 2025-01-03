<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class IndexController extends \Illuminate\Routing\Controller
{
    public function index() { 
        //dd(Auth::user());
        return Inertia::render('Index/Index', ['message' => 'Hello from Laravell']); 
    }
    public function show() { 
        //dd(Auth::user());
        return Inertia::render('Index/Show'); 
    }
}
