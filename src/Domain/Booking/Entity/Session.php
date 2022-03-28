<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketCollection;
use App\Domain\Booking\Entity\ValueObject\Date;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\MovieName;
use App\Domain\Booking\Entity\ValueObject\SessionId;
use App\Domain\Booking\Entity\ValueObject\TicketQuantity;
use App\Domain\Booking\Entity\ValueObject\Time;

class Session
{
    public const DATE_FORMAT = 'j F';
    public const DURATION_FORMAT = '%hч %iм';
    public const TIME_FORMAT = '%h:%i';
    public const PERIOD_OF_TIME_FORMAT = '%s - %s';

    private Time $timeEnd;
    private TicketQuantity $totalTicketQuantity;

    public function __construct(
        private SessionId $id,
        private MovieName $movieName,
        private Duration $duration,
        private Date $date,
        private Time $timeStart,
        TicketQuantity $ticketQuantity,
        private TicketCollection $tickets = new TicketCollection(),
    ) {
        $this->totalTicketQuantity = $ticketQuantity;
        $this->timeEnd = $this->calculateTimeEnd($date, $timeStart, $duration);
    }

    public function getTickets(): TicketCollection
    {
        return $this->tickets;
    }

    public function setTickets(TicketCollection $tickets): void
    {
        $this->tickets = $tickets;
    }

    public function getId(): SessionId
    {
        return $this->id;
    }

    public function getMovieName(): MovieName
    {
        return $this->movieName;
    }

    public function setMovieName(MovieName $movieName): void
    {
        $this->movieName = $movieName;
    }

    public function getDuration(): Duration
    {
        return $this->duration;
    }

    public function setDuration(Duration $duration): void
    {
        $this->duration = $duration;
        $this->updateTimeEnd();
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function setDate(Date $date): void
    {
        $this->date = $date;
        $this->updateTimeEnd();
    }

    public function getTimeStart(): Time
    {
        return $this->timeStart;
    }

    public function setTimeStart(Time $timeStart): void
    {
        $this->timeStart = $timeStart;
        $this->updateTimeEnd();
    }

    public function getTimeEnd(): Time
    {
        return $this->timeEnd;
    }

    public function getTotalTicketQuantity(): TicketQuantity
    {
        return $this->totalTicketQuantity;
    }

    public function setTotalTicketQuantity(TicketQuantity $totalTicketQuantity): void
    {
        $this->totalTicketQuantity = $totalTicketQuantity;
    }

    public function hasUnreservedTickets(): bool
    {
        return $this->tickets->count() < $this->totalTicketQuantity;
    }

    public function getAvailableTicketsQuantity(): int
    {
        return $this->totalTicketQuantity->getQuantity() - $this->tickets->count();
    }

    public function getDateString(): string
    {
        return $this->date->getDateTimeObject()->format(self::DATE_FORMAT);
    }

    public function getDurationString(): string
    {
        return $this->duration->getDateInterval()->format(self::DURATION_FORMAT);
    }

    public function getPeriodOfTimeString(): string
    {
        return sprintf(
            self::PERIOD_OF_TIME_FORMAT,
            $this->timeStart->getDateInterval()->format(self::TIME_FORMAT),
            $this->timeEnd->getDateInterval()->format(self::TIME_FORMAT),
        );
    }

    private function calculateTimeEnd(Date $dateStart, Time $timeStart, Duration $duration): Time
    {
        $dateTimeEnd = $dateStart
            ->getDateTimeObject()
            ->add($timeStart->getDateInterval())
            ->add($duration->getDateInterval());

        return new Time(
            $dateTimeEnd->format('H'),
            $dateTimeEnd->format('i'),
        );
    }

    private function updateTimeEnd(): void
    {
        $this->timeEnd = $this->calculateTimeEnd($this->date, $this->timeStart, $this->duration);
    }
}
