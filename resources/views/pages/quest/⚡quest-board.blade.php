<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Services\QuestService;
use Illuminate\Database\Eloquent\Collection;

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

};
?>

<div>
    {{-- Smile, breathe, and go slowly. - Thich Nhat Hanh --}}
    <ul>
        @forelse ($this->quests as $quest)
            <li>
                {{ $quest->title }}
            </li>
        @empty
            <p>No quests available</p>
        @endforelse
    </ul>

</div>