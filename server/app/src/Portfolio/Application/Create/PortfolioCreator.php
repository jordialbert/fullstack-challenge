<?php

namespace App\Portfolio\Application\Create;

use App\Allocation\Domain\Allocation;
use App\Portfolio\Domain\Portfolio;
use App\Portfolio\Domain\PortfolioRepositoryInterface;
use App\Shared\Domain\ValueObject\Shares;
use App\Shared\Domain\ValueObject\Uuid;
use Exception;
use InvalidArgumentException;

final class PortfolioCreator
{
    public function __construct(
        private PortfolioRepositoryInterface $portfolioRepository
    ) {
    }

    public function create(string $id, array $allocations): void
    {
        try {
            $uuid = new Uuid($id);

            foreach ($allocations as &$allocation) {
                $allocation = new Allocation(
                    id:     new Uuid($allocation['id']),
                    shares: new Shares($allocation['shares'])
                );
            }

            $portfolio = new Portfolio(
                id: $uuid
            );

            $this->portfolioRepository->save($portfolio);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        } catch (Exception $exception) {
            // TODO: implement logger
            throw new Exception("Couldn't create new Portfolio. Error: {$exception->getMessage()}");
        }
    }
}
