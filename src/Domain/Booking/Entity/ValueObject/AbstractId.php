<?php

namespace App\Domain\Booking\Entity\ValueObject;

abstract class AbstractId
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->setId($id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected function setId(int $id): void
    {
        $this->id = $id;
    }
}
