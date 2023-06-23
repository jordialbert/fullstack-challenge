<?php

namespace App\Tests\Portfolio\Domain;

use App\Portfolio\Domain\Portfolio;
use App\Shared\Domain\ValueObject\Uuid;
use DateTime;

final class PortfolioMother
{

    public static function apply(
        ?Uuid $id = null,
        array $allocations = [],
        array $orders = [],
        Datetime $createdAt = new DateTime(),
        DateTime$updatedAt = new DateTime()
    ): Portfolio
    {
        $id = $id ?? Uuid::random();

        return new Portfolio(
            id: $id,
            allocations: $allocations,
            orders: $orders,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );
    }

    public static function random(): Portfolio
    {
        return new Portfolio(
            id: Uuid::random(),
            allocations: [],
            orders: [],
            createdAt: new DateTime(),
            updatedAt: new DateTime()
        );
    }
}
