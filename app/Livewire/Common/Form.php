<?php

namespace App\Livewire\Common;

use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $fields = [];
    public $data = [];

    public $rules = [];

    public $isEdit = false;

    public function mount($fields = [], $data = [])
    {

        $this->fields = $fields;

        foreach ($fields as $field) {

            // 1. Inicializar datos
            $this->data[$field['name']] =  $data[$field['name']] ?? ($field['default'] ?? null);
            // 2. IMPORTANTE: Construir las reglas dentro del bucle
            if (isset($field['rules'])) {
                $this->rules['data.' . $field['name']] = $field['rules'];
            }
        }

        $this->isEdit = isset($data['id']);
    }

    public function rules()
    {
        $rules = [];
        foreach ($this->fields as $field) {
            if (isset($field['rules'])) {
                // Vinculamos la regla al array "data"
                $rules['data.' . $field['name']] = $field['rules'];
            }
        }
        return $rules;
    }

    // 3. Para que los errores no digan "data.name" sino "Nombre"
    protected function validationAttributes()
    {
        $attributes = [];
        foreach ($this->fields as $field) {
            $attributes['data.' . $field['name']] = $field['label'] ?? $field['name'];
        }
        return $attributes;
    }

    public function submit()
    {
        // 1. Validar (si falla, aquí se detiene y muestra errores en el Blade)
        $this->validate();
        //dd("Pase la validacion");

        // 2. Disparar el evento con los datos ACTUALES
        // Es vital que esto ocurra antes de resetear
        $this->dispatch('formSubmitted', $this->data);

        // 3. Cerrar el modal en el navegador
        //$this->dispatch('closeModal');

        // 4. RECIÉN AQUÍ reseteamos el formulario para que la próxima vez esté limpio
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.common.form');
    }
    public function resetForm()
    {
        // 1. Resetear los datos al estado inicial (basado en 'default')
        foreach ($this->fields as $field) {
            $this->data[$field['name']] = $field['default'] ?? null;
        }

        // Si tienes un ID (edición), hay que quitarlo
        if (isset($this->data['id'])) {
            unset($this->data['id']);
        }
        $this->isEdit = false;

        // 2. Limpiar todos los mensajes de error de validación
        $this->resetValidation();

        // 3. Opcional: Avisar al componente padre que se cerró/canceló
        $this->dispatch('formCancelled');
    }
}
