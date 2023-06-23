<?php

namespace App\Tests\Allocation\Application\Get;

use App\Allocation\Application\Get\AllocationGetter;
use App\Allocation\Domain\AllocationRepositoryInterface;
use App\Allocation\Infrastructure\Persistence\AllocationDoctrineRepository;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Allocation\Domain\AllocationMother;
use PHPUnit\Framework\TestCase;

final class AllocationGetterTest extends TestCase
{
    private $classUnderTest;

    protected function setUp(
        AllocationRepositoryInterface $orderRepositoryMock = null
    ): void
    {
        $orderRepositoryMock = $orderRepositoryMock ?? $this->createMock(AllocationRepositoryInterface::class);

        $this->classUnderTest = new AllocationGetter($orderRepositoryMock);
    }

    public function testGetAllByPortfolioShouldReturnAllocationsArray()
    {
        $portfolioUuid = Uuid::random();

        $allocations = [
            AllocationMother::random(),
            AllocationMother::random(),
        ];

        $allocationRepositoryMock = $this->createMock(AllocationRepositoryInterface::class);
        $allocationRepositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->with(['portfolio' => $portfolioUuid])
            ->willReturn($allocations);

        $this->setUp($allocationRepositoryMock);

        $this->classUnderTest->getAllByPortfolio($portfolioUuid);
    }

    public function testGetAllByPortfolioShouldReturnEmptyArray()
    {
        $portfolioUuid = Uuid::random();

        $allocations = [];

        $allocationRepositoryMock = $this->createMock(AllocationRepositoryInterface::class);
        $allocationRepositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->with(['portfolio' => $portfolioUuid])
            ->willReturn($allocations);

        $this->setUp($allocationRepositoryMock);

        $this->classUnderTest->getAllByPortfolio($portfolioUuid);
    }
}
