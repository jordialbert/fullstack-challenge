<?php

namespace App\Portfolio\Infrastructure\Controller;

use App\Portfolio\Application\Create\PortfolioCreator;
use App\Portfolio\Application\Get\PortfolioGetter;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PortfolioController extends AbstractController
{
    public function __construct(
        private readonly PortfolioCreator $portfolioCreator,
        private readonly PortfolioGetter $portfolioGetter
    ) {
    }

    #[Route('/portfolio/{id}', name: 'create', methods: ['PUT'])]
    public function create(Request $request, string $id): JsonResponse
    {
        try {
            $allocations = $request->getContent()
                ? json_decode($request->getContent(), true)['allocations']
                : [];

            $this->portfolioCreator->create(
                id: $id,
                allocations: $allocations
            );

            return new JsonResponse(
                [],
                Response::HTTP_CREATED
            );
        } catch (Exception $exception) {
            return new JsonResponse(
                [],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

//    #[Route('/portfolio/get/{id}', name: 'get', methods: ['GET'])]
//    public function get(string $id): JsonResponse
//    {
//        try {
//            $portfolio = $this->portfolioGetter->get(
//                id: $id,
//            );
//
//            $portfolioData = [
//                'id' => $portfolio->id,
//                'createdAt' => $portfolio->createdAt,
//                'updatedAt' => $portfolio->updatedAt,
//                'orders' => $portfolio->getOrdersAsArray(),
//                'allocations' => $portfolio->getAllocationsAsArray(),
//            ];
//
//            return new JsonResponse(
//                $portfolioData,
//                Response::HTTP_OK
//            );
//        } catch (InvalidArgumentException $exception) {
//            return new JsonResponse(
//                "Id provided is not valid",
//                Response::HTTP_BAD_REQUEST
//            );
//        } catch (Exception $exception) {
//            return new JsonResponse(
//                [],
//                Response::HTTP_BAD_REQUEST
//            );
//        }
//    }

    #[Route('/portfolio/get-all', name: 'get_all', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        try {
            $portfolios = $this->portfolioGetter->getAll();

            $portfoliosArray = [];

            foreach ($portfolios as $portfolio) {
                $portfolioData = [
                    'id' => $portfolio->id,
                    'createdAt' => $portfolio->createdAt,
                    'updatedAt' => $portfolio->updatedAt,
                    'orders' => $portfolio->getOrdersAsArray(),
                    'allocations' => $portfolio->getAllocationsAsArray(),
                ];
                $portfoliosArray[] = $portfolioData;
            }

            return new JsonResponse(
                $portfoliosArray,
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            return new JsonResponse(
                [],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
