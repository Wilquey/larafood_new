<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = ''
    ) {
        $data = [
           'tenant_id' => $tenantId,
           'identify' => $identify,
           'total' => $total,
           'status' => $status,
           'comment' => $comment,
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if ($tableId) $data['table_id'] = $tableId;

        // dd($data);
        
        $order = $this->entity->create($data);

        return $order;

    }

    public function getOrderByIdentify(string $identify) 
    {
        $data = $this->entity->where('identify', $identify)->first();

        return $data;
    }
    
    public function registerProductsOrder(int $idOrder, array $products)
    {
        
        // utilizando o eloquent relacionamentos laravel
        $order = $this->entity->find($idOrder);

        $orderProducts = [];

        foreach ($products as $product){
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price'],
            ];
        }

        $order->products()->attach($orderProducts);
        
        
        // utilizando o query builder
        //$orderProducts = [];
        //
        //foreach ($products as $product){
        //    array_push($orderProducts, [
        //        'order_id' => $idOrder,
        //        'product_id' => $product['id'],
        //        'qty' => $product['qty'],
        //        'price' => $product['price'],
        //    ]);
        //}
        //
        //DB::table('order_product')->insert($orderProducts);
    } 
    
    public function getOrderByClientId(int $idClient)
    {
        $orders = $this->entity->where('client_id', $idClient)->paginate();

        return $orders;
    }

       

}