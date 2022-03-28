<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\Date;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use App\Domain\Booking\Entity\ValueObject\Time;

class Ticket
{
    public function __construct(
        private TicketId $id,
        private Client $client,
        private Movie $movie,
        private Date $date,
        private Time $time,
    ) {
    }

    public function getId(): TicketId
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie): void
    {
        $this->movie = $movie;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function setDate(Date $date): void
    {
        $this->date = $date;
    }

    public function getTime(): Time
    {
        return $this->time;
    }

    public function setTime(Time $time): void
    {
        $this->time = $time;
    }
}
