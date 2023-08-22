<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
    private $file_by_platform = [
        'mac' => '/assets/EpicInstaller.dmg',
        'win' => '/assets/node-v8.6.0-x64.msi'
    ];

    //
    public function index() {
        return view('download.index');
    }

    public function download() {
        $file_path = public_path($this->file_by_platform[request('platform')]);
        return response()->download($file_path);
    }
}
