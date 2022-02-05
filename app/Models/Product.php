<?php

namespace App\Models;

use App\Models\Category;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = [
        'title',
        'flag',
        'image',
        'price',
        'description',
    ];

     /**
     * Get Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Category not linked with this products
     */
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('id', function($query){
            $query->select('category_id');
            $query->from('category_product');
            $query->whereRaw("product_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;
    }

    public function search($filter = null)
    {
        $results = $this
                    ->where('title', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }


}
