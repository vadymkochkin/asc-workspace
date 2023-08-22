<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faq_Category extends Model
{
    protected $table = 'faq_category';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'category_name',
        'order_id'
    ];

    static public function get_faq_category_data($filtedval = '')
    {
        if ($filtedval) {
            return DB::table('faq_category')->where('category_name', 'like', '%' . $filtedval . '%')->orderBy('order_id', 'asc')->get();
        } else {
            return DB::table('faq_category')->orderBy('order_id', 'asc')->get();
        }
    }
}
