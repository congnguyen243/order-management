<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    //public function getOrder();
    public function storeOrder($attributes = [],$item = []);
    public function updateOrder($attributes = [],$item = []);
}
