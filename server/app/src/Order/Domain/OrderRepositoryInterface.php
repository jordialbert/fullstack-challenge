<?php

namespace App\Order\Domain;

use App\Shared\Domain\ValueObject\Uuid;

interface OrderRepositoryInterface
{
    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        $limit = null,
        $offset = null
    ): array;

    public function find(Uuid $id, $lockMode = null, $lockVersion = null): ?Order;

    public function save(Order $entity): void;
}
