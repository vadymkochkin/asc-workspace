<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    //
    protected $table = 'news';

    protected $fillable = [
                      'id',
                      'user_id',
                      'image',
                      'title',
                      'tags',
                      'description',
                      'is_active',
                    ];

    static public function get_news_data($filtedval) {
        if($filtedval) {
            return DB::table('news')->where('title', 'like', '%' . $filtedval . '%')->orWhere('description', 'like', '%' . $filtedval . '%')->orWhere('tags', 'like', '%' . $filtedval . '%')->get();
        } else {
            return DB::table('news')->get();
        }
    }

    public function User()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }



}
