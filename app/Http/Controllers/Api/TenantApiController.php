<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TenantService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;

class TenantApiController extends Controller
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page',15);

        $tentats = $this->tenantService->getAllTenants($per_page);

        return TenantResource::collection($tentats);
    }

    public function show($uuid)
    {
        $tenant = $this->tenantService->getTenantByUuid($uuid);

        if (!$tenant){
            return response()->json(['message' => 'Not Found'], 404);
        }           
        
        return new TenantResource($tenant);
        
    }




}
