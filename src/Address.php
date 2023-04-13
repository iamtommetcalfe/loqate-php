<?php

namespace Iamtommetcalfe\Loqate;

/**
 * Represents an individual address from the Loqate API.
 *
 * @category   AddressVerification
 * @package    Iamtommetcalfe\Loqate
 * @author     Tom Metcalfe <iamtommetcalfe@gmail.com>
 * @license    MIT License
 * @link       https://github.com/iamtommetcalfe/loqate-php
 */
class Address
{
    private string $id;
    private string $type;
    private string $text;

    public function __construct(array $data)
    {
        $this->setId($data['Id'] ?? '')
            ->setType($data['Type'] ?? '')
            ->setText($data['Text'] ?? '');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
}
