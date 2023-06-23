<?php

namespace App\Order\Application\Get;

use App\Order\Domain\OrderRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

final class OrderGetter
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {
    }

    public function getAllByPortfolio(Uuid $id): array
    {
        return $this->orderRepository->findBy(
            ['portfolio' => $id],
            ['createdAt' => 'desc']
        );
    }
}
