<?php
declare(strict_types=1);

namespace Tests\Unit;


use ipinfo\ipinfo\IPinfo;
use PHPUnit\Framework\TestCase;

class IpInfoLookupServiceTest extends TestCase
{
    /** @test */
    public function it_can_fetch_ip_information()
    {
        $ip = 'foo';

        $mock = $this->createMock(IPinfo::class);
        $mock->expects($this->once())->method('getDetails')->with($ip)
            ->willReturn((object) ['city' => 'Delft', 'country' => 'The Netherlands']);

        $service = new \App\Services\IpInfoLookupService($mock);
        $result = $service->lookupIp($ip);

        $this->assertEquals('Delft', $result->getCity());
        $this->assertEquals('The Netherlands', $result->getCounty());
    }
}
