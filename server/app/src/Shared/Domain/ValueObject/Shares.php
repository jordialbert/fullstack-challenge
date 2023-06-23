<?php

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;

readonly class Shares
{
    public function __construct(
        public int $shares
    ) {
        $this->isValid($this->shares);
    }

    private function isValid(int $shares): void
    {
        if ($shares < 0) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $shares));
        }
    }
}
