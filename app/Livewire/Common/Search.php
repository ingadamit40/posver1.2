<?php

namespace App\Livewire\Common;

use Livewire\Component;

class Search extends Component
{
    public $model;
    public $field = 'name';
    public $search = '';
    public $results = [];
    public $selectedId;
    public $selectedLabel;

    public function updatedSearch()
    {
        $class = $this->model;

        $this->results = $class::where($this->field, 'like', "%{$this->search}%")
            ->limit(10)
            ->get();
    }

    public function selectItem($id, $label)
    {
        $this->selectedId = $id;
        $this->selectedLabel = $label;
        $this->search = $label;
        $this->results = [];

        $this->dispatch('select-search-selected', id: $id);
    }

    public function render()
    {
        return view('livewire.common.search');
    }
}
