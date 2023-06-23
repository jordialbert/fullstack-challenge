<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\ValueObject\Shares;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class SharesType extends IntegerType
{
    private function typeClassName(): string
    {
        return Shares::class;
    }

    public function getName(): string
    {
        return 'shares';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->typeClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var Shares $value */
        return $value->shares;
    }
}
