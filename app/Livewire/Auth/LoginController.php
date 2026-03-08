<?php

namespace App\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginController extends Component
{
    public $title;
    public $email;
    public $password;

    public function mount(): void
    {
        $this->title = 'POSInventory';
    }
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        // Aquí puedes agregar la lógica de autenticación utilizando $this->email y $this->password
        // Por ejemplo, podrías usar Auth::attempt() para verificar las credenciales del usuario
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $messages = [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El campo de correo electrónico debe ser una dirección de correo válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];

        $this->validate($rules, $messages);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Autenticación exitosa
            // Redirige al usuario a la página deseada después de iniciar sesión
            session()->regenerate();

            session()->flash('welcome', Auth::user()->name);

            // Redirige con parámetro simple
            return redirect()->route('dashboard');
        }

        $this->reset(['email', 'password']);
        $this->resetValidation();
        $this->dispatch('login-error', message: 'Credenciales incorrectas');
    }
}
