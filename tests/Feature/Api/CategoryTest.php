<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * Test Get Error Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(422);
    }

    /**
     * Test Get Error Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';

        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = factory(Category::class)->create();

        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    
}
