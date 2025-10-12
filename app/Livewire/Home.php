<?php

namespace App\Livewire;

use Livewire\Component;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.index');
    }
}
