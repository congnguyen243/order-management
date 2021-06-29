<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name','phone','avatar','address','email','date','quantity', 'total', 'note'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_order')->withPivot('quantity');
    }
}
