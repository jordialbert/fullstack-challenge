<?php

namespace App\Order\Application\SetState;

use App\Order\Domain\OrderRepositoryInterface;
use App\Order\Domain\OrderState;
use App\Shared\Domain\ValueObject\Uuid;

final class OrderStateSetter
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {
    }
    public function set(string $id, string $state): void
    {
        $uuid = new Uuid($id);
        $orderState = new OrderState($state);

        $order = $this->orderRepository->find($uuid);
        $order->state = $orderState;
        $order->updatedAt = new \DateTime();

        $this->orderRepository->save($order);
    }
}
