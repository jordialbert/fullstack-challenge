<?php

namespace App\Tests\Allocation\Domain;

use App\Allocation\Domain\Allocation;
use App\Portfolio\Domain\Portfolio;
use App\Shared\Domain\ValueObject\Shares;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Portfolio\Domain\PortfolioMother;

final class AllocationMother
{
    public static function apply(
        ?Uuid $id = null,
        ?Shares $shares = null,
        ?Portfolio $portfolio = null,
        array $orders = []
    ): Allocation
    {
        $id = $id ?? Uuid::random();
        $shares = $shares ?? new Shares(rand(1,30));

        $portfolio = $portfolio ?? PortfolioMother::random();

        return new Allocation(
            id:        $id,
            shares:    $shares,
            portfolio: $portfolio,
            orders:    $orders
        );
    }

    public static function random(): Allocation
    {
        return new Allocation(
            id:        Uuid::random(),
            shares:    new Shares(rand(1,30)),
            portfolio: PortfolioMother::random(),
            orders:    []
        );
    }
}
