<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildController extends Controller
{
    public function index()
    {
      return view('build.index');
    }
}
