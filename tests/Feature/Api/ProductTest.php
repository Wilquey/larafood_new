<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Test Get Error Products by Tenant.
     *
     * @return void
     */
    public function testGetAllProductsTenantError()
    {
        $tenant = 'fake_value';
        
        $response = $this->getJson("/api/products?token_company={$tenant}");

        $response->assertStatus(422);
    }

    /**
     * Test Get Error Products by Tenant.
     *
     * @return void
     */
    public function testGetAllProductsByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/products?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Product by Tenant
     *
     * @return void
     */
    public function testErrorGetProductByTenant()
    {
        $product = 'fake_value';

        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/products/{$product}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Product by Tenant
     *
     * @return void
     */
    public function testGetProductByIdentify()
    {
        $tenant = factory(Tenant::class)->create();

        $product = factory(Product::class)->create();
        
        $response = $this->getJson("/api/products/{$product->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
