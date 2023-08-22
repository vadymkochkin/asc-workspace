<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'store_items';

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
      'itemid',
      'name',
      'quality',
      'vp_price',
      'dp_price',
      'realm',
      'description',
      'video',
      'icon',
      'group',
      'query',
      'query_database',
      'query_need_character',
      'command',
      'command_need_character',
      'require_character_offline',
      'tooltip',
      'headline',
      'body',
      'features',
      'additional_images',
      'featured_image',
      'additional_headline',
      'additional_text',
  ];

    public function Realm()
    {
        return $this->hasOne('App\Models\Realm','id','realm');
    }
    public function Group()
    {
        return $this->hasOne('App\Models\StoreGroup','id','group');
    }

    public function scopeRealmHasTotalItem($query,$realm_id){
      $total_item  = $query->where(['is_active' => 1])->where(['realm' => $realm_id])->count();
     return ($total_item > 0 ? $total_item : 0);
    }
    public function scopeRealmHasTotalGroup($query,$realm_id){
      $total_item  = $query->where(['is_active' => 1])->where(['realm' => $realm_id])->select('group')->distinct()->get()->count();
     return ($total_item > 0 ? $total_item : 0);
    }

    public $timestamps = false;

}
