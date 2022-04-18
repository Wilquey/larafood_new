<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    /**
     * Test Get Error Tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/tables');

        $response->assertStatus(422);
    }

    /**
     * Test Get Error Tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Table by Tenant
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $table = 'fake_value';

        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
