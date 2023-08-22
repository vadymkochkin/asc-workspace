<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Changelog_type extends Model
{
  protected $fillable = [
      'typeName',
  ];
  public $timestamps = false;
}
