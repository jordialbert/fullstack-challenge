<?php

namespace App\Order\Infrastructure\Persistence;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Doctrine\AbstractDoctrineEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderDoctrineRepository extends AbstractDoctrineEntityRepository implements OrderRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry
    )
    {
        parent::__construct($registry, Order::class);
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function find(mixed $id, $lockMode = null, $lockVersion = null): ?Order
    {
        return parent::find($id);
    }

    public function save(mixed $entity): void
    {
        parent::save($entity);
    }
}
