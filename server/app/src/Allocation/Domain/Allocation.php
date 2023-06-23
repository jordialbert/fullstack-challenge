<?php

namespace App\Allocation\Domain;

use App\Portfolio\Domain\Portfolio;
use App\Shared\Domain\ValueObject\Shares;
use App\Shared\Domain\ValueObject\Uuid;

class Allocation
{
    public function __construct(
        public Uuid $id,
        public Shares $shares,
        public ?Portfolio $portfolio = null,

        // Doctrine specific properties
        public $orders = []
    ) {
    }

    public function getOrdersAsArray(): array
    {
        return $this->orders->getValues();
    }
}
