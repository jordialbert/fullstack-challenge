<?php

namespace App\Order\Domain;

use InvalidArgumentException;

readonly class OrderState
{
    public const ORDER_STATES = [
        'placed',
        'accepted',
        'rejected'
    ];

    public function __construct(
        public string $state
    ) {
        $this->isValid($state);
    }

    private function isValid(string $state): void
    {
        if (!in_array($state, self::ORDER_STATES)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $state));
        }
    }
}
