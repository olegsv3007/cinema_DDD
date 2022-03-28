<?php

namespace App\Domain\Booking\Entity\ValueObject;

use App\Domain\Booking\Exception\NegativeTicketQuantityException;

class TicketQuantity
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->setQuantity($quantity);
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function validateQuantity(int $quantity): void
    {
        $this->validateQuantityIsPositive($quantity);
    }

    public function validateQuantityIsPositive(int $quantity): void
    {
        if ($quantity < 0) {
            throw new NegativeTicketQuantityException();
        }
    }

    private function setQuantity(int $quantity): void
    {
        $this->validateQuantity($quantity);
        $this->quantity = $quantity;
    }
}
