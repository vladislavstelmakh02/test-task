<?php

namespace app\services;

use app\models\DishesModel;

class DishesService
{
    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return DishesModel::where('id', $id)->exists();
    }
}
