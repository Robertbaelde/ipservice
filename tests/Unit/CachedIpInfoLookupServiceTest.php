<?php
declare(strict_types=1);

namespace Tests\Unit;


use App\Dto\IpLookupData;
use App\Services\CachedIpInfoLookupService;
use App\Services\IpInfoLookupService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CachedIpInfoLookupServiceTest extends TestCase
{
    /** @test */
    public function it_fetches_the_response_from_the_service_when_no_cache_available()
    {
        $this->markTestSkipped("skipped for now due to cache");

        $ip = 'foo';

        $expectedResult = new IpLookupData('Delft', 'The Netherlands');

        Cache::shouldReceive('remember')
            ->once()
            ->with("ip_lookup_{$ip}")
            ->andReturn(null);

        $ipServiceMock = $this->createMock(IpInfoLookupService::class);
        $ipServiceMock->expects($this->once())
            ->method('lookupIp')
            ->with($ip)
            ->willReturn($expectedResult);

        $service = new CachedIpInfoLookupService($ipServiceMock);
        $result = $service->lookupIp($ip);

        $this->assertEquals($expectedResult, $result);

    }
}
