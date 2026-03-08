<?php

namespace App\Livewire\Common;

use Livewire\Component;

class Form extends Component
{
    public $fields = [];
    public $data = [];

    public function mount($fields = [])
    {
        $this->fields = $fields;

        foreach ($fields as $field) {
            $this->data[$field['name']] = $field['default'] ?? null;
        }
    }

    public function submit()
    {
        $this->dispatch('form-submit', data: $this->data);
    }

    public function render()
    {
        return view('livewire.common.form');
    }
}
