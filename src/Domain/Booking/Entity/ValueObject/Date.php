<?php

namespace App\Domain\Booking\Entity\ValueObject;

use App\Domain\Booking\Exception\DateDoesntExistException;
use DateTime;

class Date
{
    private int $month;
    private int $day;
    private int $year;

    public function __construct(int $month, int $day, int $year)
    {
        $this->validateDate($month, $day, $year);
        $this->setMonth($month);
        $this->setDay($day);
        $this->setYear($year);
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
            throw new DateDoesntExistException();
        }
    }

    private function setMonth(int $month): void
    {
        $this->month = $month;
    }

    private function setDay(int $day): void
    {
        $this->day = $day;
    }

    private function setYear(int $year): void
    {
        $this->year = $year;
    }
}
