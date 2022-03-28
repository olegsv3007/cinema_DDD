<?php

namespace App\Domain\Booking\Entity\ValueObject;

use DateInterval;

class Time
{
    public function __construct(private int $hours, private int $minutes)
    {
        $this->validateHours($hours);
        $this->validateMinutes($minutes);
    }

    public function getHours(): int
    {
        return $this->hours;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function getDateInterval(): DateInterval
    {
        return new DateInterval(sprintf('PT%dH%dM', $this->hours, $this->minutes));
    }

    private function validateHours(int $hours): void
    {
        if ($hours < 0 || $hours > 23) {
            throw new \InvalidArgumentException();
        }
    }

    private function validateMinutes(int $minutes): void
    {
        if ($minutes < 0 || $minutes > 59) {
            throw new \InvalidArgumentException();
        }
    }
}
