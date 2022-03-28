<?php

namespace App\Domain\Booking\Entity\ValueObject;

class Client
{
    public function __construct(private ClientName $clientName, private PhoneNumber $phoneNumber)
    {
    }

    public function getClientName(): ClientName
    {
        return $this->clientName;
    }

    public function setClientName(ClientName $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(PhoneNumber $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
}
