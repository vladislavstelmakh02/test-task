<?php

namespace app\controllers;

use app\models\ReceiptModel;
use app\services\CooksService;
use app\services\DishesService;
use app\services\ReceiptsService;

class CaffeController extends AbstractController
{
    private DishesService $dishesService;
    private ReceiptsService $receiptsService;
    private CooksService $cooksService;

    public function __construct()
    {
        parent::__construct();

        $this->dishesService = new DishesService();
        $this->receiptsService = new ReceiptsService();
        $this->cooksService = new CooksService();
    }

    /**
     * @param int $dishId
     * @return void
     */
    public function createReceipt(int $dishId): void
    {
        if (!$this->dishesService->exists($dishId)) {
            $this->response->json([
                'message' => "Dish with id {$dishId} not found.",
            ], 0);
        }

        $dishId = $this->receiptsService->add($dishId);

        $this->response->json([
            'message' => "Receipt #{$dishId} successfully created!",
        ], 0);
    }

    /**
     * @param int $id
     * @param int $dishId
     * @return void
     */
    public function addToReceipt(int $id, int $dishId): void
    {
        if (!$this->receiptsService->exists($id)) {
            $this->response->json([
                'message' => "Receipt #{$id} not found.",
            ], 0);
        }

        if (!$this->dishesService->exists($dishId)) {
            $this->response->json([
                'message' => "Dish with id {$dishId} not found.",
            ], 0);
        }

        $dishes = ReceiptModel::getDishes($id);
        $dishes[] = $dishId;

        $isUpdated = $this->receiptsService->update($id, $dishes);

        if ($isUpdated) {
            $this->response->json([
                'message' => "The dish with id {$dishId} was added to receipt #{$dishId}.",
            ], 0);
        }

        $this->response->json([
            'message' => "The dish with id {$dishId} wasn't added to receipt.",
        ], 0);
    }

    /**
     * @return void
     */
    public function getPopularCook(): void
    {
        $receipts = ReceiptModel::all();

        $cooks = $this->cooksService->getPopulars($receipts);

        $this->response->json([
           'data' => $cooks,
        ], 0);
    }
}
