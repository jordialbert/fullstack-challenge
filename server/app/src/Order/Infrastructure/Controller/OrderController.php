<?php

namespace App\Order\Infrastructure\Controller;

use App\Order\Application\Get\OrderGetter;
use App\Order\Application\SetState\OrderStateSetter;
use App\Shared\Domain\ValueObject\Uuid;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class OrderController extends AbstractController
{
    public function __construct(
        private readonly OrderGetter $orderGetter,
        private readonly OrderStateSetter $orderStateSetter
    ) {
    }

    #[Route('/order/get-all-by-portfolio', name: 'order_get_all_by_portfolio', methods: ['GET'])]
    public function getAll(Request $request): JsonResponse
    {
        try {
            $uuid = new Uuid($request->get('portfolioId'));

            return new JsonResponse(
                $this->orderGetter->getAllByPortfolio($uuid),
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

    #[Route('/order/{id}/set-state', name: 'order_set_state', methods: ['PUT'])]
    public function setState(Request $request, string $id): JsonResponse
    {
        $body = json_decode($request->getContent());
        try {
            $this->orderStateSetter->set($id, $body->state);
            return new JsonResponse(
                [],
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
