<?php

namespace App\Tests\Portfolio\Application\Create;

use App\Portfolio\Application\Create\PortfolioCreator;
use App\Portfolio\Infrastructure\Persistence\Doctrine\PortfolioMapper;
use App\Portfolio\Infrastructure\Persistence\PortfolioDoctrineRepository;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class PortfolioCreatorTest extends TestCase
{
    private $classUnderTest;

    /**
     * @dataProvider getValidPayloads
     */
    public function testCreateShouldCreateNewPortfolio(
        string $id,
        array $allocations
    ): void
    {
        $portfolioRepositoryMock = $this->createMock(PortfolioDoctrineRepository::class);
        $portfolioRepositoryMock
            ->expects($this->once())
            ->method('save');

        $this->classUnderTest = new PortfolioCreator($portfolioRepositoryMock);

        $this->classUnderTest->create($id, $allocations);
    }

    /**
     * @dataProvider getInvalidPayloads
     * @throws \Exception
     */
    public function testCreateShouldThrowExceptionWhenInvalidPayloadIsGiven(string $id, array $allocations)
    {
        $portfolioRepositoryMock = $this->createMock(PortfolioDoctrineRepository::class);
        $portfolioRepositoryMock
            ->expects($this->never())
            ->method('save');

        $this->classUnderTest = new PortfolioCreator($portfolioRepositoryMock);

        $this->expectException(\Exception::class);

        $this->classUnderTest->create($id, $allocations);
    }

    public function getValidPayloads(): array
    {
        return [
            "Payload 1" => [
                Uuid::random()->value,
                [
                    [
                        "id" => Uuid::random()->value,
                        "shares" => rand(1, 20)
                    ]
                ]
            ],
            "Payload 2" => [
                Uuid::random()->value,
                [
                    [
                        "id" => Uuid::random()->value,
                        "shares" => rand(1, 20)
                    ]
                ]
            ],
            "Payload 3" => [
                Uuid::random()->value,
                [
                    [
                        "id" => Uuid::random()->value,
                        "shares" => rand(1, 20)
                    ]
                ]
            ]
        ];
    }

    public function getInvalidPayloads(): array
    {
        return [
            "Payload without shares" => [
                Uuid::random()->value,
                [
                    [
                        "id" => Uuid::random()->value
                    ]
                ]
            ],
            "Payload without AllocationID" => [
                Uuid::random()->value,
                [
                    [
                        "shares" => rand(1, 20)
                    ]
                ]
            ],
            "Payload without PortfolioId" => [
                '',
                [
                    [
                        "id" => Uuid::random()->value,
                        "shares" => rand(1, 20)
                    ]
                ]
            ]
        ];
    }
}
