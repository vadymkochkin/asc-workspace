<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News_comment extends Model
{
  protected $fillable = [
                    'id',
                    'news_id',
                    'user_id',
                    'comment',
                    'is_active',
                  ];

  public function User()
  {
      return $this->hasOne('App\Models\User','id','user_id');
  }

}
