<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory');
    }

    public function subsubcategories()
    {
        return $this->hasMany('App\Models\Subsubcategory');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
