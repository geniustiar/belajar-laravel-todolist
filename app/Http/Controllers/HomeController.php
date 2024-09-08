<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(request $request): RedirectResponse
    {
        if($request->session()->exists('user')) {
            return redirect('/todolist');
        } else {
            return redirect("/login");
        }
    }
}
