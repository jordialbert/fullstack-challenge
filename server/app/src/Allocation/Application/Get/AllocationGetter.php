<?php

namespace App\Allocation\Application\Get;

use App\Allocation\Domain\AllocationRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

final class AllocationGetter
{
    public function __construct(
        private AllocationRepositoryInterface $allocationRepository
    ) {
    }

    public function getAllByPortfolio(Uuid $id): array
    {
        return $this->allocationRepository->findBy([
            'portfolio' => $id
        ]);
    }
}
