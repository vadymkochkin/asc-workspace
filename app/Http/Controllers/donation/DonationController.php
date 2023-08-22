<?php

namespace App\Http\Controllers\donation;
use Auth;
use Validator;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function hub()
    {
      return view('donation.hub');
    }

    public function donate()
    {
      return view('donation.donate');
    }
}
