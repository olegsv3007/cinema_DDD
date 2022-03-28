<?php

namespace App\Domain\Booking\Entity\Collection;

use App\Domain\Booking\Entity\Ticket;
use Iterator;

class TicketCollection
{
    private int $count;

    /**
     * @param array<Ticket> $tickets
     */
    public function __construct(private array $tickets = [])
    {
        $this->count = count($tickets);
    }

    public function addTicket(Ticket $ticket): void
    {
        $this->tickets[] = $ticket;
        $this->count++;
    }

    public function removeTicket(Ticket $ticket): bool
    {
        $key = $this->exist($ticket);

        if ($key === false) {
            return false;
        }

        unset($this->tickets[$key]);
        $this->count--;

        return true;
    }

    public function exist(Ticket $ticket): false|int|string
    {
        return array_search($ticket, $this->tickets, true);
    }

    /**
     * @return array<Ticket>
     */
    public function all(): array
    {
        return $this->tickets;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function getGenerator(): Iterator
    {
        foreach ($this->tickets as $ticket) {
            yield $ticket;
        }
    }
}
