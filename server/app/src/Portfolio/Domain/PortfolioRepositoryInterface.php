<?php

namespace App\Portfolio\Domain;

use App\Shared\Domain\ValueObject\Uuid;

interface PortfolioRepositoryInterface
{
    /**
     * @return array|Portfolio[]
     */
    public function findAll(): array;

    public function find(Uuid $id, $lockMode = null, $lockVersion = null): ?Portfolio;

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Portfolio;
}
