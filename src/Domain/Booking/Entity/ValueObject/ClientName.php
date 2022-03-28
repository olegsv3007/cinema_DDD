<?php

namespace App\Domain\Booking\Entity\ValueObject;

use App\Domain\Booking\Exception\EmptyClientNameException;

class ClientName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): void
    {
        $this->validateName($name);
        $this->name = $name;
    }

    private function validateName(string $name): void
    {
        $this->validateNameIsNotEmpty($name);
    }

    private function validateNameIsNotEmpty(string $name): void
    {
        if (empty($name)) {
            throw new EmptyClientNameException();
        }
    }
}
