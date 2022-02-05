<?php

use App\Models\{
    Tenant,
    Category
};
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first(); 
        
        $tenant->category->create([
            'name' => 'Categoria1',
            'url' => 'categoria1',
            'description' => 'desc categoria1',
        ]      
        );
    }
}
