<?php

namespace App\Portfolio\Infrastructure\Persistence;

use App\Portfolio\Domain\Portfolio;
use App\Portfolio\Domain\PortfolioRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Doctrine\AbstractDoctrineEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PortfolioDoctrineRepository extends AbstractDoctrineEntityRepository implements PortfolioRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry
    )
    {
        parent::__construct($registry, Portfolio::class);
    }

    /**
     * @return array|Portfolio[]
     */
    public function findAll(): array
    {
        return parent::findAll();
    }

    public function find(mixed $id, $lockMode = null, $lockVersion = null): ?Portfolio
    {
        return parent::find($id);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Portfolio
    {
        return parent::findOneBy($criteria, $orderBy);
    }
}
