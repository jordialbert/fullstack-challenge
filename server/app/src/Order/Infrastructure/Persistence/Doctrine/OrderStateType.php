<?php

namespace App\Order\Infrastructure\Persistence\Doctrine;

use App\Order\Domain\OrderState;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class OrderStateType extends StringType
{
    private function typeClassName(): string
    {
        return OrderState::class;
    }

    public function getName(): string
    {
        return 'order_state';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        $className = $this->typeClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var OrderState $value */
        return $value->state;
    }
}
