<?php

namespace App\Portfolio\Application\Get;

use App\Portfolio\Domain\Portfolio;
use App\Portfolio\Domain\PortfolioRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Exception;
use InvalidArgumentException;

final class PortfolioGetter
{
    public function __construct(
        private PortfolioRepositoryInterface $portfolioRepository
    ) {
    }

    public function get(string $id): ?Portfolio
    {
        try {
            $uuid = new Uuid($id);
            return $this->portfolioRepository->find($uuid);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        } catch (Exception $exception) {
            // TODO: implement logger
            throw new Exception("Couldn't find Portfolio with id $id. Error: {$exception->getMessage()}");
        }
    }

    public function getAll(): array
    {
        return $this->portfolioRepository->findAll();
    }
}
