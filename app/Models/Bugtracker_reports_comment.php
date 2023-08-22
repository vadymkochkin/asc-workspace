<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bugtracker_reports_comment extends Model
{
    //
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne('App\Models\User','id','user');
    }
    public function Report()
    {
        return $this->hasOne('App\Models\Bugtracker_report','id','report');
    }
}
