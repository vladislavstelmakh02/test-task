<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class CooksModel extends Model
{
    protected $table = 'cooks';

    protected $fillable = [
        'id',
        'name',
    ];
}
