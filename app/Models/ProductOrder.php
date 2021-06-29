<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'product_order';

    protected $fillable = ['quantity','product_id','order_id'];

    public $timestamps = false;

    public function getProductsOfOrder($idOrder)
    {
        return ProductOrder::where('order_id', $idOrder)->join('products', 'product_order.product_id', '=', 'products.id')->get();
    }
}
