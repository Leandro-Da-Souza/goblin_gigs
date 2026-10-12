<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Services\QuestService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On; 

new class extends Component
{
    protected QuestService $questService;

    public function boot(QuestService $questService): void
    {
        $this->questService = $questService;
    }

    #[Computed]
    public function quests(): Collection 
    {
        return $this->questService->getQuests();
    }

    #[On('quest-created')]
    public function updateQuestListing(): void
    {}

};
?>

<div>
    {{-- Smile, breathe, and go slowly. - Thich Nhat Hanh --}}
    <livewire:quest.form />
    <ul class="quest-board">
        @forelse ($this->quests as $quest)
            <li class="quest-board__item">
                {{ $quest->title }}
            </li>
        @empty
            <li>No quests available</li>
        @endforelse
    </ul>

</div>