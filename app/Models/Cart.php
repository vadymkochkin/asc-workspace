<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

  protected $guarded = [
      'id',
  ];

  protected $fillable = [
      'id',
      'user_id'
  ];

  public function items()
  {
      return $this->hasMany('App\Models\Cart_item', 'cart_id','id');
  }
}
