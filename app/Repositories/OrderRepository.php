<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = '',
        $tableId = ''
    ) {

    };
    public function getOrderByIdentify(string $identify) 
    {

    };  
       

}