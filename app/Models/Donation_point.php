<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation_point extends Model
{
    const ACTIVE   = 1;
    const INACTIVE = 0;

    protected $fillable = ['user_id', 'added_dp', 'previous_dp', 'total_dp','used_dp', 'isactive'];

    public function scopeUserCurrentDp($query,$user_id){
      $user_dp  = $query->where(['isactive' => 1])->where(['user_id' => $user_id])->first();
     return (isset($user_dp)?$user_dp->total_dp : 0);
    }
}
