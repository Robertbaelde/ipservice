<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;


use App\Dto\IpLookupData;
use App\Services\IpLookupServiceInterface;
use Tests\TestCase;

class IpLookupControllerTest extends TestCase
{
    /** @test */
    public function it_can_lookup_a_ip_address()
    {
        $ip = '2a02:a442:356b:1:906f:9856:96:4f1c';
        $ipLookupMock = $this->createMock(IpLookupServiceInterface::class);
        $ipLookupMock->expects($this->once())
            ->method('lookupIp')
            ->with($ip)
            ->willReturn(new IpLookupData('Delft', 'The Netherlands'));

        $this->app->instance(IpLookupServiceInterface::class, $ipLookupMock);

        $response = $this->json('get', 'api/ip-lookup?ip=' . $ip);

        $response->assertJson([
            'data' => [
                'city' => 'Delft',
                'country' => 'The Netherlands'
            ]
        ]);
    }
}
