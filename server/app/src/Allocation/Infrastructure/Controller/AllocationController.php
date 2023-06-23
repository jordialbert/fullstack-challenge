<?php

namespace App\Allocation\Infrastructure\Controller;

use App\Allocation\Application\Get\AllocationGetter;
use App\Shared\Domain\ValueObject\Uuid;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AllocationController extends AbstractController
{
    public function __construct(
        private readonly AllocationGetter $allocationGetter
    ) {
    }

    #[Route('/allocation/get-all-by-portfolio', name: 'allocation_get_all_by_portfolio', methods: ['GET'])]
    public function getAll(Request $request): JsonResponse
    {
        try {
            $uuid = new Uuid($request->get('portfolioId'));

            $allocations = $this->allocationGetter->getAllByPortfolio($uuid);

            $allocationsArray = [];

            foreach ($allocations as $allocation) {
                $allocationData = [
                    'id' => $allocation->id,
                    'shares' => $allocation->shares,
                    'portfolio' => $allocation->portfolio,
                    'orders' => $allocation->getOrdersAsArray(),
                ];
                $allocationsArray[] = $allocationData;
            }

            return new JsonResponse(
                $allocationsArray,
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            // TODO: implement logger and log exception
            return new JsonResponse(
                [],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
