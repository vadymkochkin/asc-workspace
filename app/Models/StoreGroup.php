<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreGroup extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'store_groups';

  /**
   * The attributes that are not mass assignable.
   *
   * @var array
   */
  protected $guarded = [
      'id',
  ];
  /**
   * Fillable fields for a Profile.
   *
   * @var array
   */
  protected $fillable = [
      'id',
      'title',
      'image',
      'slug',
  ];


}
