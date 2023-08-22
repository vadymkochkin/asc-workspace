<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
  const REALM_STATUS_ACTIVE   = 1;
  const REALM_STATUS_INACTIVE = 0;

  protected $fillable = [
      'realm_name',
      'realm_host_name',
      'realm_port',
      'char_db_name',
      'char_db_host_name',
      'char_db_user_name',
      'char_db_password',
      'char_db_port',
      'world_console_host',
      'world_console_username',
      'world_console_password',
      'world_console_port ',
      'slug',
      'image',
      'is_active'
  ];
  public $timestamps = false;
}
