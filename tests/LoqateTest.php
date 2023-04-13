<?php

namespace Yourusername\Loqate\Tests;

use Iamtommetcalfe\Loqate\Address;
use Iamtommetcalfe\Loqate\Loqate;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class LoqateTest extends TestCase
{
    private string $apiKey = 'sample-api-key';

    public function testVerifyAddress()
    {
        $mockResponse = json_encode([
            'Items' => [
                [
                    'Id' => 'GB|RM|A|12345678',
                    'Type' => 'Address',
                    'Text' => '10 Downing Street, London, SW1A 2AA',
                    'Highlight' => '0-24',
                ]
            ]
        ]);

        $mock = new MockHandler([
            new Response(200, [], $mockResponse),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $loqate = new Loqate($this->apiKey, $client);
        $search = '10 Downing Street, London';
        $verifiedAddress = $loqate->verifyAddress($search);

        $address = $verifiedAddress[0];

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('GB|RM|A|12345678', $address->getId());
        $this->assertEquals('Address', $address->getType());
        $this->assertEquals('10 Downing Street, London, SW1A 2AA', $address->getText());
    }

    public function testVerifyAddressNoResults()
    {
        $mockResponse = json_encode([
            'Items' => []
        ]);

        $mock = new MockHandler([
            new Response(200, [], $mockResponse),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $loqate = new Loqate($this->apiKey, $client);
        $search = 'Invalid address';
        $verifiedAddress = $loqate->verifyAddress($search);

        $this->assertNull($verifiedAddress);
    }
}
