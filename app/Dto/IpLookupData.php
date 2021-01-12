<?php
declare(strict_types=1);

namespace App\Dto;


class IpLookupData
{
    private string $city;
    private string $county;

    public function __construct(string $city, string $county)
    {
        $this->city = $city;
        $this->county = $county;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCounty(): string
    {
        return $this->county;
    }
}
