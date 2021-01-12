<?php
declare(strict_types=1);

namespace App\Services;


use App\Dto\IpLookupData;

interface IpLookupServiceInterface
{
    public function lookupIp(string $ip): IpLookupData;
}
