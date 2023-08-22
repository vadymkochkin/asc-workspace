<?php

namespace App\Http\Controllers;

class SupportController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('support.contact');
    }

}
