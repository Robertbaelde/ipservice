<?php
declare(strict_types=1);

namespace App\Services;


use App\Dto\IpLookupData;
use Illuminate\Support\Facades\Cache;

class CachedIpInfoLookupService implements IpLookupServiceInterface
{
    private IpLookupServiceInterface $ipLookupService;

    public function __construct(IpLookupServiceInterface $ipLookupService)
    {
        $this->ipLookupService = $ipLookupService;
    }

    public function lookupIp(string $ip): IpLookupData
    {
        return Cache::remember($this->getCacheKeyFromIp($ip), now()->addWeek(), fn() => $this->ipLookupService->lookupIp($ip));
    }

    private function getCacheKeyFromIp(string $ip)
    {
        return "ip_lookup_{$ip}";
    }
}
