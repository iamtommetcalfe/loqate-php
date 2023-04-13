<?php

namespace Iamtommetcalfe\Loqate;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Loqate API wrapper for address verification
 *
 * @category AddressVerification
 * @package  Iamtommetcalfe\Loqate
 * @author   Tom Metcalfe <iamtommetcalfe@gmail.com>
 * @license  MIT License
 * @link     https://github.com/iamtommetcalfe/loqate-php
 */
class Loqate
{
    private string $apiKey;
    private ?Client $client;

    /**
     * Constructor
     *
     * @param string      $apiKey Loqate API key
     * @param Client|null $client Optional Guzzle client to be used for testing
     */
    public function __construct(string $apiKey, Client $client = null)
    {
        $this->apiKey = $apiKey;
        $this->client = $client ?? new Client(
            [
                'base_uri' => 'https://api.addressy.com/'
            ]
        );
    }

    /**
     * Verify an address
     *
     * @param string $search  Address to be verified
     * @param string $country ISO country code, default is 'GB'
     *
     * @throws GuzzleException
     *
     * @return array|null Array of verified address items or null if no results found
     */
    public function verifyAddress(string $search, string $country = 'GB'): ?array
    {
        $response = $this->client->get(
            'Capture/Interactive/Find/v1.10/json3.ws',
            [
                'query' => [
                    'Key' => $this->apiKey,
                    'Text' => $search,
                    'Country' => $country
                ]
            ]
        );

        $addressVerification = new AddressVerification($response->getBody());

        return $addressVerification->getVerifiedAddresses();
    }
}
