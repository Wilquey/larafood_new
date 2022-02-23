<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use TenantTrait;

    protected $fillable = [
        'identify',
        'client_id',
        'table_id',
        'total',
        'status',
        'comment',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function table()
    {
        return $this->belongsTo(Product::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }



}
