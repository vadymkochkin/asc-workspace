<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
  protected  $primaryKey = 'change_id';
  protected $fillable = [
      'changelog',
      'user_id',
      'user_id',
      'type',
      'time',
      'is_ptr',
  ];
  public $timestamps = false;

  public function Change_type()
  {
      return $this->hasOne('App\Models\Changelog_type', 'id','type');
  }
  public function User()
  {
      return $this->hasOne('App\Models\User','id','user_id');
  }

  public function scopeNextInterval($query,$interval,$logs){
    $hasMoreLogs  = $query->where(['is_ptr' => 0])->skip(($interval+1)*$logs)->take(($interval+2)*$logs)->get()->count();
    return ($hasMoreLogs > 0 ? ++$interval : 0);
  }
}
