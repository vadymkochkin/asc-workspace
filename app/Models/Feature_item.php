<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Feature_item extends Model
{

  public function StoreItem()
    {
        return $this->hasOne('App\Models\StoreItem','id','store_item_id');
    }

}
