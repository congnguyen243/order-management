<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * All Product
     *
     * @return void
     */
    public function index()
    {
        $data = $this->productRepo->getAll();
        return view('product.index')->with('products', $data);
    }
}
