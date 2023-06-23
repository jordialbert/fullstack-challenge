<?php

namespace App\Tests\Portfolio\Application\Get;

use App\Portfolio\Application\Get\PortfolioGetter;
use App\Portfolio\Domain\Portfolio;
use App\Portfolio\Domain\PortfolioRepositoryInterface;
use App\Portfolio\Infrastructure\Persistence\Doctrine\PortfolioMapper;
use App\Portfolio\Infrastructure\Persistence\PortfolioDoctrineRepository;
use App\Shared\Domain\Service\EntityMapperInterface;
use App\Tests\Portfolio\Domain\PortfolioMother;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class PortfolioGetterTest extends TestCase
{
    private $classUnderTest;

    protected function setUp(
        ?PortfolioRepositoryInterface $portfolioRepositoryMock = null
    ): void
    {
        $portfolioRepositoryMock = $portfolioRepositoryMock ?? $this->createMock(PortfolioDoctrineRepository::class);

        $this->classUnderTest = new PortfolioGetter($portfolioRepositoryMock);
    }

    public function testGetShouldReturnPortfolio()
    {
        $portfolio = PortfolioMother::random();

        $portfolioRepositoryMock = $this->createMock(PortfolioDoctrineRepository::class);
        $portfolioRepositoryMock
            ->expects($this->once())
            ->method('find')
            ->with($portfolio->id)
            ->willReturn($portfolio);

        $this->setUp($portfolioRepositoryMock);

        $portfolioResult = $this->classUnderTest->get($portfolio->id->value);

        $this->assertInstanceOf(Portfolio::class, $portfolioResult);
        $this->assertSame($portfolio, $portfolioResult);
    }

    public function testGetShouldThrowExceptionWithInvalidId()
    {
        $invalidId = '1';

        $this->setUp();

        $this->expectException(InvalidArgumentException::class);
        $portfolioResult = $this->classUnderTest->get($invalidId);
    }

    public function testGetAllShouldReturnArrayOfPortfolios()
    {
        $portfolios = [
            PortfolioMother::random(),
            PortfolioMother::random(),
            PortfolioMother::random()
        ];

        $portfolioRepositoryMock = $this->createMock(PortfolioDoctrineRepository::class);
        $portfolioRepositoryMock
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($portfolios);

        $this->setUp($portfolioRepositoryMock);

        $portfoliosResult = $this->classUnderTest->getAll();

        $this->assertIsArray($portfoliosResult);

        foreach ($portfoliosResult as $key => $portfolioResult) {
            $this->assertSame($portfolios[$key], $portfolioResult);
        }
    }
}
