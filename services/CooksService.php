<?php

namespace app\services;

use app\models\DishesModel;
use app\models\ReceiptModel;
use Illuminate\Support\Collection;

class CooksService
{
    public function getPopulars(Collection $receipts): array
    {
        $dishIds = [];
        foreach($receipts as $receipt) {
            $dishes = ReceiptModel::getDishes($receipt->id);

            foreach ($dishes as $dish) {
                $dishIds[] = $dish;
            }
        }

        $rate = array_count_values($dishIds);

        $cooks = [];
        foreach($rate as $dishId => $count) {
            $dish = DishesModel::where('id', $dishId)->first();
            $cooks[] = array_merge(
                $dish
                    ->cook
                    ->select('id', 'name')
                    ->where('id', $dish->cook_id)
                    ->first()
                    ->toArray(),
                [
                    'ordered_dishes' => $count,
                ]
            );
        }

        usort($cooks, function ($a, $b) {
            return intval($a['ordered_dishes'] < $b['ordered_dishes']);
        });

        return $cooks;
    }
}