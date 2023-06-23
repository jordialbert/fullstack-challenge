<?php

namespace App\Allocation\Infrastructure\Persistence;

use App\Allocation\Domain\Allocation;
use App\Allocation\Domain\AllocationRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Doctrine\AbstractDoctrineEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AllocationDoctrineRepository extends AbstractDoctrineEntityRepository implements AllocationRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, Allocation::class);
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function find(mixed $id, $lockMode = null, $lockVersion = null, bool $returnDomainEntity = true): ?Allocation
    {
        return parent::find($id);
    }
}
