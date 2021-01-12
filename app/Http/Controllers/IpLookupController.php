<?php

namespace App\Http\Controllers;

use App\Services\IpLookupServiceInterface;
use Illuminate\Http\Request;

class IpLookupController extends Controller
{
    /**
     * @var IpLookupServiceInterface
     */
    private IpLookupServiceInterface $ipLookupService;

    public function __construct(IpLookupServiceInterface $ipLookupService)
    {
        $this->ipLookupService = $ipLookupService;
    }

    public function lookupIp(Request $request)
    {
        $ipData = $this->ipLookupService->lookupIp($request->get('ip'));
        return response()->json([
            'data' => [
                'city' => $ipData->getCity(),
                'country' => $ipData->getCounty()
            ]
        ]);
    }
}
