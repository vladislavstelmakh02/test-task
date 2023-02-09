<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DishesModel extends Model
{
    protected $table = 'dishes';

    protected $fillable = [
        'name',
        'cook_id'
    ];

    public function cook(): BelongsTo
    {
        return $this->belongsTo(CooksModel::class, 'cook_id');
    }
}
