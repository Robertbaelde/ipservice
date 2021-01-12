<?php
declare(strict_types=1);

namespace App\Services;

use App\Dto\IpLookupData;
use ipinfo\ipinfo\IPinfo;

class IpInfoLookupService implements IpLookupServiceInterface
{
    private IPinfo $IPinfo;

    public function __construct(IPinfo $IPinfo)
    {
        $this->IPinfo = $IPinfo;
    }

    public function lookupIp(string $ip): IpLookupData
    {
        $details = $this->IPinfo->getDetails($ip);
        return new IpLookupData($details->city, $details->country);
    }
}
