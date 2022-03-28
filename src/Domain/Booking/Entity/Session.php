<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketCollection;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\Date;
use App\Domain\Booking\Entity\ValueObject\PhoneNumber;
use App\Domain\Booking\Entity\ValueObject\SessionId;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use App\Domain\Booking\Entity\ValueObject\Time;
use App\Domain\Booking\Exception\TicketsAreOverException;
use DateTime;

class Session
{
    public function __construct(
        private SessionId $id,
        private Movie $movie,
        private DateTime $dateTimeStart,
        private Hall $hall,
        private TicketCollection $bookedTickets = new TicketCollection(),
    ) { }

    public function getTickets(): TicketCollection
    {
        return $this->bookedTickets;
    }

    public function getId(): SessionId
    {
        return $this->id;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getDate(): Date
    {
        return new Date(
            $this->dateTimeStart->format('m'),
            $this->dateTimeStart->format('d'),
            $this->dateTimeStart->format('Y'),
        );
    }

    public function getTimeStart(): Time
    {
        return new Time(
            $this->dateTimeStart->format('H'),
            $this->dateTimeStart->format('i'),
        );
    }

    public function getTimeEnd(): Time
    {
        $dateTimeEnd = $this->dateTimeStart->add($this->movie->getDuration()->getDateInterval());

        return new Time(
            $dateTimeEnd->format('H'),
            $dateTimeEnd->format('i'),
        );
    }

    public function hasFreeTickets(): bool
    {
        return $this->bookedTickets->count() < $this->hall->getTotalSeats();
    }

    public function getFreeTicketsQuantity(): int
    {
        return $this->hall->getTotalSeats() - $this->bookedTickets->count();
    }

    public function bookTicket(BookTicketDTO $ticketDTO): Ticket
    {
        if (!$this->hasFreeTickets()) {
            throw new TicketsAreOverException();
        }

        $client = new Client(
            $ticketDTO->clientName,
            new PhoneNumber($ticketDTO->phoneNumber),
        );

        $ticket = new Ticket(
            new TicketId(),
            $client,
            $this,
        );

        $this->bookedTickets->add($ticket);

        return $ticket;
    }
}
