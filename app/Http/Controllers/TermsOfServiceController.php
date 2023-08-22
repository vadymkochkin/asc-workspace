<?php

namespace App\Http\Controllers;

class TermsOfServiceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tos()
    {
        return view('tos.terms_of_service');
    }
}
