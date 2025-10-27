<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

     public function subcategory(){
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function subsubcategory(){
        return $this->belongsTo('App\Models\Subsubcategory');
    }
    
    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }

    public function attribute_values()
    {
        return $this->hasMany('App\Models\AttributeValue');
    }

    public function campaing_products() {
        return $this->hasOne(CampaingProduct::class);
    }

}
