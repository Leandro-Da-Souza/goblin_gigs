<?php

use App\Enums\QuestStatus;
use App\Models\Quest;
use Livewire\Livewire;

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

    it('Given valid inputs, a new quest should be added to the board ', function () {
        $response = $this->get('/quests');

        $response->assertSeeLivewire('quest.form');

        $board = Livewire::test('pages::quest.quest-board')->assertSee('No quests available');

        $newQuest = [
            'title' => 'New Quest',
            'description' => 'A piping hot quest',
            'status' => QuestStatus::OPEN,
        ];

        Livewire::test('quest.form')
            ->set('title', $newQuest['title'])
            ->set('description', $newQuest['description'])
            ->set('status', $newQuest['status'])
            ->call('handleSubmit')
            ->assertHasNoErrors()
            ->assertDispatched('quest-created');

        $this->assertDatabaseHas('quests', [
            'title' => $newQuest['title'],
            'description' => $newQuest['description'],
            'status' => $newQuest['status']->value,
        ]);

        $board->dispatch('quest-created')
            ->assertSee($newQuest['title'])
            ->assertDontSee('No quests available');

    });
});
