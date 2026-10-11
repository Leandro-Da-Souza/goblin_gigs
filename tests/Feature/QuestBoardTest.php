<?php

use App\Enums\QuestStatus;
use App\Models\Quest;

describe('QuestBoard', function () {
    it('Given a quest exists, visting /quests displays its title', function () {
        $quest = Quest::create([
            'title' => 'Create a quest',
            'status' => QuestStatus::OPEN,
        ]);

        $response = $this->get('/quests');

        $response->assertOk()
            ->assertSee($quest->title);

    });

    it('Given no quests, visiting /quest display "No quests available"', function () {
        $response = $this->get('/quests');
        $response->assertOk()
            ->assertSee('No quests available');
    });
});
