<?php

namespace App\Tests\Order\Domain;

use App\Allocation\Domain\Allocation;
use App\Order\Domain\Order;
use App\Order\Domain\OrderState;
use App\Order\Domain\OrderType;
use App\Portfolio\Domain\Portfolio;
use App\Shared\Domain\ValueObject\Shares;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Allocation\Domain\AllocationMother;
use App\Tests\Portfolio\Domain\PortfolioMother;
use DateTime;

final class OrderMother
{
    public static function apply(
        ?Uuid $id = null,
        ?Shares $shares = null,
        ?OrderType $type = null,
        ?OrderState $state = null,
        ?Portfolio $portfolio = null,
        ?Allocation $allocation = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ): Order
    {
        $id = $id ?? Uuid::random();
        $shares = $shares ?? new Shares(rand(1,30));
        $type = $type ?? new OrderType(OrderType::ORDER_TYPES[rand(0,1)]);
        $state = $state ?? new OrderState(OrderState::ORDER_STATES[rand(0,2)]);
        $portfolio = $portfolio ?? PortfolioMother::random();
        $allocation = $allocation ?? AllocationMother::random();
        $createdAt = $createdAt ?? new DateTime();
        $updatedAt = $updatedAt ?? new DateTime();

        return new Order(
            id:         $id,
            shares:     $shares,
            type:       $type,
            state:      $state,
            portfolio:  $portfolio,
            allocation: $allocation,
            createdAt:  $createdAt,
            updatedAt:  $updatedAt
        );
    }

    public static function random(): Order
    {
        return new Order(
            id:         Uuid::random(),
            shares:     new Shares(rand(1,30)),
            type:       new OrderType(OrderType::ORDER_TYPES[rand(0,1)]),
            state:      new OrderState(OrderState::ORDER_STATES[rand(0,2)]),
            portfolio:  PortfolioMother::random(),
            allocation: AllocationMother::random(),
            createdAt:  new DateTime(),
            updatedAt:  new DateTime()
        );
    }
}
