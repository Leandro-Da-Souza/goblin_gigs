<?php

namespace App\Services;

use App\Enums\QuestStatus;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Collection;

class QuestService
{
    /**
     * @return Collection<int, Quest>
     */
    public function getQuests(): Collection
    {
        return Quest::all();
    }

    /**
     * @param array{
     *     title: string,
     *     description: string|null,
     *     status: QuestStatus|string
     * } $quest
     */
    public function saveQuest(array $quest): Quest
    {
        return Quest::create($quest);
    }
}
