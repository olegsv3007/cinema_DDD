<?php

namespace App\Domain\Booking\Entity\ValueObject;

use App\Domain\Booking\Exception\InvalidPhoneNumberException;

class PhoneNumber
{
    private string $number;

    public function __construct(string $number)
    {
        $this->setNumber($number);
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function validatePhoneNumber(string $number): void
    {
        $this->validatePhoneNumberFormat($number);
    }

    public function validatePhoneNumberFormat(string $number): void
    {
        if (!preg_match('/^[0-9]{9,14}\z/', $number)) {
            throw new InvalidPhoneNumberException();
        }
    }

    private function setNumber(string $number): void
    {
        $this->validatePhoneNumber($number);
        $this->number = $number;
    }
}
