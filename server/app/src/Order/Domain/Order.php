<?php

namespace App\Order\Domain;

use App\Allocation\Domain\Allocation;
use App\Portfolio\Domain\Portfolio;
use App\Shared\Domain\ValueObject\Shares;
use App\Shared\Domain\ValueObject\Uuid;
use DateTime;

class Order
{
    public function __construct(
        public readonly Uuid $id,
        public Shares $shares,
        public OrderType $type,
        public OrderState $state,
        public Portfolio $portfolio,
        public Allocation $allocation,
        public readonly ?DateTime $createdAt = null,
        public ?DateTime $updatedAt = null
    ) {
    }
}
