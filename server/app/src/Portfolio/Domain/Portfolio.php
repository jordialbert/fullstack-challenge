<?php

namespace App\Portfolio\Domain;

use App\Shared\Domain\ValueObject\Uuid;
use DateTime;

class Portfolio
{
    public function __construct(
        public Uuid $id,
        public ?DateTime $createdAt = new DateTime(),
        public ?DateTime $updatedAt = new DateTime(),

        // Doctrine specific properties
        public $allocations = [],
        public $orders = [],
    ) {
    }

    public function getOrdersAsArray(): array
    {
        return $this->orders->getValues();
    }

    public function getAllocationsAsArray(): array
    {
        return $this->allocations->getValues();
    }
}
