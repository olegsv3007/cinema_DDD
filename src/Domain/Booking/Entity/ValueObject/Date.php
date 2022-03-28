<?php

namespace App\Domain\Booking\Entity\ValueObject;

use DateTime;
use InvalidArgumentException;

class Date
{
    public function __construct(private int $month, private int $day, private int $year)
    {
        $this->validateDate($month, $day, $year);
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getDateTimeObject(): DateTime
    {
        return new DateTime(sprintf('%d-%d-%d', $this->year, $this->month, $this->day));
    }

    private function validateDate(int $month, int $day, int $year): void
    {
        $this->validateDateExists($month, $day, $year);
    }

    private function validateDateExists(int $month, int $day, int $year): void
    {
        if (checkdate($month, $day, $year)) {
            throw new InvalidArgumentException();
        }
    }
}
