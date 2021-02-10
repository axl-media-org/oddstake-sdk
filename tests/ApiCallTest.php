<?php

namespace AxlMedia\OddstakeSdk\Test;

use AxlMedia\OddstakeSdk\Facade as Oddstake;
use GuzzleHttp\Psr7\Response;

class ApiCallTest extends TestCase
{
    public function test_call_works_for_xml()
    {
        $handlerStack = $this->generateMockHandler([
            new Response(200, ['Content-Type' => 'application/xml'], file_get_contents('tests/response.xml')),
        ]);

        $json = Oddstake::handler($handlerStack)->soccer('england');

        $expectedXml = simplexml_load_string(file_get_contents('tests/response.xml'));
        $expectedJson = @json_decode(json_encode($expectedXml), true);

        $this->assertSame($json, $expectedJson);
    }

    public function test_url_is_built()
    {
        $url = Oddstake::debug()->soccer('england');

        $this->assertSame(
            'http://feeds.oddstake.com/get-feed/soccer/odds-extended/england',
            $url
        );
    }
}
