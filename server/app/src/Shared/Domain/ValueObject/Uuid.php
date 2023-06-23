<?php

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

readonly class Uuid
{
    public function __construct(
        public string $value
    ) {
        $this->isValid($value);
    }

    public static function random(): self
    {
        return new self(SymfonyUuid::v4()->uid);
    }

    public function equals(Uuid $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function isValid(string $id): void
    {
        if (!SymfonyUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
