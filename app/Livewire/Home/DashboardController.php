<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.theme.app')]

class DashboardController extends Component
{
    public $welcome;

    public function mount($welcome = null)
    {
        if (session()->has('welcome')) {

            $this->dispatch(
                'show-welcome',
                name: session('welcome')
            );
        }
    }

    public function render()
    {
        return view('livewire.home.dashboard');
    }
}
