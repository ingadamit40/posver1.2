<?php

namespace App\Livewire\Common;

use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public $model;
    public $columns = [];
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {

            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $model = $this->model;

        $query = $model::query();

        // BUSQUEDA GLOBAL
        if ($this->search) {

            $query->where(function ($q) {

                foreach ($this->columns as $column) {

                    if ($column['searchable'] ?? false) {
                        $q->orWhere($column['field'], 'like', '%' . $this->search . '%');
                    }
                }
            });
        }

        // ORDENAMIENTO
        $query->orderBy($this->sortField, $this->sortDirection);

        $data = $query->paginate($this->perPage);

        return view('livewire.common.data-table', [
            'data' => $data
        ]);
    }
}
