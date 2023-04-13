<?php

namespace Iamtommetcalfe\Loqate;

/**
 * AddressVerification class to handle Loqate API response parsing
 *
 * @category AddressVerification
 * @package  Iamtommetcalfe\Loqate
 * @author   Tom Metcalfe <iamtommetcalfe@gmail.com>
 * @license  MIT License
 * @link     https://github.com/iamtommetcalfe/loqate-php
 */
class AddressVerification
{
    private array $data;

    /**
     * Constructor
     *
     * @param string $responseBody JSON response from Loqate API
     */
    public function __construct(string $responseBody)
    {
        $this->data = json_decode($responseBody, true);
    }

    /**
     * Get verified address items from the API response
     *
     * @return array|null Array of verified address items or null if no results found
     */
    public function getVerifiedAddresses(): ?array
    {
        if (isset($this->data['Items']) && count($this->data['Items']) > 0) {
            return array_map(
                fn ($item) => new Address($item),
                $this->data['Items']
            );
        } else {
            return null;
        }
    }
}
