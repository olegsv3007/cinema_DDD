<?php

namespace App\Domain\Booking\Entity\ValueObject;

use App\Domain\Booking\Exception\InvalidHoursValueException;
use App\Domain\Booking\Exception\InvalidMinutesValueException;
use DateInterval;

class Time
{
    private int $hours;
    private int $minutes;

    public function __construct(int $hours, int $minutes)
    {
        $this->setHours($hours);
        $this->setMinutes($minutes);
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

    private function setHours(int $hours): void
    {
        $this->validateHours($hours);
        $this->hours = $hours;
    }

    private function validateHours(int $hours): void
    {
        if ($hours < 0 || $hours > 23) {
            throw new InvalidHoursValueException();
        }
    }

    private function setMinutes(int $minutes): void
    {
        $this->validateMinutes($minutes);
        $this->minutes = $minutes;
    }

    private function validateMinutes(int $minutes): void
    {
        if ($minutes < 0 || $minutes > 59) {
            throw new InvalidMinutesValueException();
        }
    }
}
