<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }
    
    public function getProductsByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                    ->where('products.tenant_id', $idTenant)
                    ->get();
    }

    

}