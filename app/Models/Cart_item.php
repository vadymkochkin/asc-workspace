<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
  const CHARACTER_TYPE_SELF      = 1;
  const CHARACTER_TYPE_OTHER     = 0;

      protected $guarded = [
          'id',
      ];

      protected $fillable = [
          'cart_id ',
          'store_item_id ',
          'realm_id ',
          'item_quantity ',
          'character_type',
          'item_dp_cost ',
          'character_name ',
          'soap_reply',
          'status '
      ];
      public function store_items()
      {
          return $this->hasOne('App\Models\StoreItem', 'id','store_item_id');
      }
      public function cart()
      {
          return $this->hasOne('App\Models\Cart', 'id','cart_id');
      }


}
