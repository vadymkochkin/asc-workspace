<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bugtracker_report extends Model
{
  const LIVE_SERVER_ID   = 0;

  public function Category()
  {
      return $this->hasOne('App\Models\Bugtracker_categories', 'id','bugtracker_category_id');
  }
  public function Subcategory()
  {
      return $this->hasOne('App\Models\Bugtracker_subcategory', 'id','subcategory_id');
  }
  public function Expansion()
  {
      return $this->hasOne('App\Models\Bugtracker_expansion', 'id','expansion_id');
  }
  public function Area()
  {
      return $this->hasOne('App\Models\Bugtracker_area', 'id','area_id');
  }
  public function Zone()
  {
      return $this->hasOne('App\Models\Bugtracker_zone', 'id','zone_id');
  }
  public function Realm()
  {
      return $this->hasOne('App\Models\Realm','id','realm');
  }
  public $timestamps = false;


}
