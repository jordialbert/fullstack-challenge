<?php

namespace App\Allocation\Domain;

use App\Shared\Domain\ValueObject\Uuid;

interface AllocationRepositoryInterface
{
    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        $limit = null,
        $offset = null
    ): array;

    public function find(Uuid $id, $lockMode = null, $lockVersion = null, bool $returnDomainEntity = true): ?Allocation;
}
