<?php

namespace App\Order\Domain;

use InvalidArgumentException;

readonly class OrderType
{
    public const ORDER_TYPES = [
        'buy',
        'sell',
    ];

    public function __construct(
        public string $type
    ) {
        $this->isValid($type);
    }

    private function isValid(string $type): void
    {
        if (!in_array($type, self::ORDER_TYPES)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $type));
        }
    }
}
