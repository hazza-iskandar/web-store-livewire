<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
