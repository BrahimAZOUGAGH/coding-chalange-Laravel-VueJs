<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Category can belong to one category parent
     * 
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    /**
     * Category has the possibility to having many category children's
     * 
     */
    public function childrens()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    /**
     * Category has many products
     * 
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
