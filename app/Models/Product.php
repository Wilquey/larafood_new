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



}
