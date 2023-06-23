<?php

namespace App\Tests\Order\Application\Get;

use App\Order\Application\Get\OrderGetter;
use App\Order\Domain\OrderRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Order\Domain\OrderMother;
use PHPUnit\Framework\TestCase;

final class OrderGetterTest extends TestCase
{
    private $classUnderTest;

    protected function setUp(
        OrderRepositoryInterface $orderRepositoryMock = null
    ): void
    {
        $orderRepositoryMock = $orderRepositoryMock ?? $this->createMock(OrderRepositoryInterface::class);

        $this->classUnderTest = new OrderGetter($orderRepositoryMock);
    }

    public function testGetAllByPortfolioShouldReturnAllocationsArray()
    {
        $portfolioUuid = Uuid::random();

        $orders = [
            OrderMother::random(),
            OrderMother::random(),
        ];

        $orderRepositoryMock = $this->createMock(OrderRepositoryInterface::class);
        $orderRepositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->with(['portfolio' => $portfolioUuid])
            ->willReturn($orders);

        $this->setUp($orderRepositoryMock);

        $this->classUnderTest->getAllByPortfolio($portfolioUuid);
    }

    public function testGetAllByPortfolioShouldReturnEmptyArray()
    {
        $portfolioUuid = Uuid::random();

        $orders = [];

        $orderRepositoryMock = $this->createMock(OrderRepositoryInterface::class);
        $orderRepositoryMock
            ->expects($this->once())
            ->method('findBy')
            ->with(['portfolio' => $portfolioUuid])
            ->willReturn($orders);

        $this->setUp($orderRepositoryMock);

        $this->classUnderTest->getAllByPortfolio($portfolioUuid);
    }
}
