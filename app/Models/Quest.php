<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\QuestStatus;

class Quest extends Model
{
    protected function casts(): array {
        return [
            'status' => QuestStatus::class
        ];
    }

    protected $fillable = [
        'title',
        'description',
        'status'
    ];
}
