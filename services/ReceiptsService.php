<?php

namespace app\services;

use app\models\ReceiptModel;

class ReceiptsService
{
    /**
     * @param int $dishId
     * @return int
     */
    public function add(int $dishId): int
    {
        return ReceiptModel::insertGetId([
            'dish_id' => json_encode([$dishId]),
            'open_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function update(int $id, array $dishes): bool
    {
        return ReceiptModel::where('id', $id)
            ->update([
                'dish_id' => json_encode($dishes),
            ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return ReceiptModel::where('id', $id)->exists();
    }
}