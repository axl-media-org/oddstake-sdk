<?php

namespace AxlMedia\OddstakeSdk\Test;

use AxlMedia\OddstakeSdk\Facade as Oddstake;

class HelpersTest extends TestCase
{
    public function test_list()
    {
        foreach (Oddstake::getSupportedCountries() as $country) {
            $this->assertNotNull($country['feed_name'] ?? null);
        }
    }
}
