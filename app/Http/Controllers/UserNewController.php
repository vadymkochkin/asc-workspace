<?php

namespace App\Http\Controllers;

class UserNewController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ucpnew.pages.user.index');
    }

}
