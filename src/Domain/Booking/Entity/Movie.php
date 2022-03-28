<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\MovieId;
use App\Domain\Booking\Entity\ValueObject\MovieName;

class Movie
{
    public function __construct(private MovieId $id, private MovieName $name)
    {
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getName(): MovieName
    {
        return $this->name;
    }

    public function setName(MovieName $name): void
    {
        $this->name = $name;
    }
}
