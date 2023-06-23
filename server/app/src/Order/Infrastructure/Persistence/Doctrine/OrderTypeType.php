<?php

namespace App\Order\Infrastructure\Persistence\Doctrine;

use App\Order\Domain\OrderType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class OrderTypeType extends StringType
{
    private function typeClassName(): string
    {
        return OrderType::class;
    }

    public function getName(): string
    {
        return 'order_type';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        $className = $this->typeClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var OrderType $value */
        return $value->type;
    }
}
