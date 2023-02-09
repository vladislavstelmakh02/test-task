<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class ReceiptModel extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'dish_id',
        'open_date',
    ];

    public static function getDishes(int $id): array
    {
        $dishes = self::select('dish_id')
            ->where('id', $id)
            ->first()
            ->toArray();

        return json_decode($dishes['dish_id']);
    }
}
