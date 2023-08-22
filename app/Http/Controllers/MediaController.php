<?php

namespace App\Http\Controllers;

class MediaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function watch()
    {
        return view('media.watch');
    }

}
