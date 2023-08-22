<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_recent_connection extends Model
{
    const CONNECTION_TYPE_USER_PANEL = 1;
    const CONNECTION_TYPE_LAUNCHER = 2;
    const CONNECTION_TYPE_GAME = 3;

    protected $fillable = ['user_id', 'action_type', 'connection_address', 'connection_country', 'connected_at'];
    protected $dates = ['connected_at'];
    public $timestamps = false;
}
