<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faq extends Model
{
    //
    protected $table = 'faq';
    public $timestamps = false;

    protected $fillable = [
                      'id',
                      'user_id',
                      'content',
                      'type',
                      'created',
                      'is_active',
                    ];

    static public function get_faq_data($filtedval) {
        if($filtedval) {
            return DB::table('faq')->where('title', 'like', '%' . $filtedval . '%')->orWhere('description', 'like', '%' . $filtedval . '%')
                ->select('faq.id', 'faq.content', 'faq.created_at', 'faq.is_active', 'faq.answer', 'faq_category.category_name')
                ->leftJoin('faq_category', 'faq.cat_id', '=', 'faq_category.id')->get();
        } else {
            return DB::table('faq')
                ->select('faq.id', 'faq.content', 'faq.created_at', 'faq.is_active', 'faq.answer', 'faq_category.category_name')
                ->leftJoin('faq_category', 'faq.cat_id', '=', 'faq_category.id')->get();
        }
    }

    static public function get_faqdata_by_category($categories = array(), $q) {
        $result = array();
        if(count($categories) > 0) {
            foreach ($categories as $ca) {
                $urow = [];
                $urow['id'] = $ca->id;
                $urow['category_name'] = $ca->category_name;

                $query = DB::table('faq')
                    ->select('faq.id', 'faq.content', 'faq.created_at', 'faq.is_active', 'faq.answer', 'faq_category.category_name')
                    ->leftJoin('faq_category', 'faq.cat_id', '=', 'faq_category.id')->where('is_active', 1)->where('cat_id', $ca->id);
                if($q) {
                    $query->where('content', 'like', '%' . $q . '%')->orWhere('answer', 'like', '%' . $q . '%');
                }
                $urow['data'] = $query->get();
                $result[] = $urow;
            }
        }
        return $result;
    }

    public function User()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
