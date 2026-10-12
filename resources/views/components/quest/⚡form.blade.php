<?php

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Quest;
use App\Enums\QuestStatus;
use App\Services\QuestService;

new class extends Component
{
    protected QuestService $questService;

    public string $title = '';
    public string $description = '';
    public QuestStatus $status = QuestStatus::OPEN;

    public function boot(QuestService $questService): void
    {
        $this->questService = $questService;
    }

    protected function rules()
    {
        return [
            'title' => [
                'required',
                Rule::string()->max(255),
            ],
            'description' => [
                'nullable',
                Rule::string()
            ],
            'status' => [
                'required',
                Rule::enum(QuestStatus::class)
                    ->only([QuestStatus::OPEN, QuestStatus::IN_PROGRESS])
            ]
        ];
    }
    
    public function handleSubmit(): void 
    {
        $newQuest = $this->validate();

        $this->questService->saveQuest($newQuest);

        $this->reset('title', 'description', 'status');

        $this->dispatch('quest-created');
    }
};
?>

<div>
    {{-- You must be the change you wish to see in the world. - Mahatma Gandhi --}}
    <form class="quest-form" wire:submit='handleSubmit'>
        <div class="quest-form__title">
            <label for="title">Quest Title</label>
            <input type="text" name="title" id="title" wire:model='title'>
        </div>
        <div class="quest-form__description">
            <label for="description">Quest Description</label>
            <input type="text" name="description" id="description" wire:model='description'>
        </div>
        <div class="quest-form__status">
            <label for="status">Quest Status</label>
            <select name="status" id="status" wire:model='status'>
                <option value="{{ QuestStatus::OPEN->value }}" >Open</option>
                <option value="{{ QuestStatus::IN_PROGRESS->value }}">In Progress</option>
            </select>
        </div>
        <button>Submit</button>
    </form>
</div>