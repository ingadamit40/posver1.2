<?php

namespace App\Livewire\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Illuminate\Http\RedirectResponse;

use Livewire\Component;

class Login extends Component
{
    public $title;
    public $email;
    public $password;

    public function mount(): void
    {
        $this->title = 'POSInventory';
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
