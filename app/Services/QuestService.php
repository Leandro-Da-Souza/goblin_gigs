<?php

namespace App\Services;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Collection;

class QuestService
{

    public function getQuests(): Collection {
        return Quest::all();
    }
}
