<?php

namespace App\Http\Controllers\Acknowledgement;
use App\Http\Controllers\Controller;
use Auth;

class AcknowledgementController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy()
    {
        return view('acknowledgement.privacy_policy');
    }
    public function refundPolicy()
    {
        return view('acknowledgement.refund_policy');
    }
}
