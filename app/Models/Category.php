<?php

namespace App\Models;

use App\Models\Product;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'name',
        'url',
        'description',
    ];

    /**
     * Get Products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Products not linked with this categories
     */
    public function productsAvailable($filter = null)
    {
        $products = Product::whereNotIn('id', function ($query) {
            $query->select('product_id');
            $query->from('category_product');
            $query->whereRaw("category_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('products.title', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $products;
    }


    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }

    
}
