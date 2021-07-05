<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mews\Purifier\Facades\Purifier;
use App\Http\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

class OrderController extends Controller
{
    use StoreImageTrait;

    protected $orderRepo;
    protected $productRepo;
    protected $productOrder;

    public function __construct(OrderRepositoryInterface $orderRepo, ProductRepositoryInterface $productRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->productOrder = new ProductOrder();
    }

    public function index()
    {
        $data = $this->orderRepo->getAll();
        $dataProduct = $this->productRepo->getAll();
        return view('order.index')->with('orders', $data)->with('dataProduct', $dataProduct);
    }

    /**
     * Create Order
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $params = $request->only('name','phone','address','date','email','total','quantity','avatar','note');

        $items = $request['item'];

        $validated = $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|digits:10',
            'address' => 'required|max:100',
            'date' => 'required|date|before_or_equal:today',
            'email' => 'required|email',
            'total' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'avatar' => 'image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:448',
            'note' => 'max:300'
        ]);

        // //apply traits
        $params['avatar'] = $this->verifyAndStoreImage($request, 'avatar', 'orders');

        $order = $this->orderRepo->storeOrder($params, $items);

        $result = array(
            'status' => '200',
            'data' => $params,
        );

        return response()->json($result);
    }

    /**
     * Show Order
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $order = $this->orderRepo->find($id);
        $productOrder = $this->productOrder->getProductsOfOrder($id);
        $products = $this->productRepo->getAll();
        $result = array(
            'order' => $order,
            'productOrder' => $productOrder,
            'products' => $products
        );

        if ($request->ajax()) {
            return view('order.form-order')->with('orderItem', $order)->with('dataProduct', $products)->with('productOfOrder', $productOrder);
        };
    }

    /**
     * Get All
     *
     * @param Request $request
     * @return void
     */
    public function getAll(Request $request)
    {
        $data = $this->orderRepo->getAll();

        if ($request->ajax()) {
            return view('order.data-content')->with('orders', $data);
        }
    }

    /**
     * Delete Order
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $idOrder = $request['id'];
        $flag = $this->orderRepo->delete($idOrder);
        $result = array(
            'status' => '200',
            'data' => $flag,
        );
        return response()->json($result);
    }

    /**
     * Update Order
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $params = $request->all();
        $items = $request['item'];
        $validated = $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|digits:10',
            'address' => 'required|max:100',
            'date' => 'required|date|before_or_equal:today',
            'email' => 'required|email',
            'total' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'avatar' => 'image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:448',
            'note' => 'max:300'
        ]);
        
        $imgUpdate = $this->verifyAndStoreImage($request, 'avatar', 'orders');
        
        if($imgUpdate != null){
            $params['avatar'] = $imgUpdate;
        }

        $this->orderRepo->updateOrder($params, $items);
        $result = array(
            'status' => '200',
            'data' => $params
        );
        return response()->json($result);
    }
}
