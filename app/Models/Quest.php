<?php

namespace App\Models;

use App\Enums\QuestStatus;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected function casts(): array
    {
        return [
            'status' => QuestStatus::class,
        ];
    }

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
