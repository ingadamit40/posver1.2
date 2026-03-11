<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.theme.app')]

class CategoriasController extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    #[Validate('required|min:3')]
    public $name;

    public $status = true;

    #[Validate('nullable|image|max:2048')]
    public $image;
    public $image_current;
    public $category_id;
    public $componentName = 'Categorias';
    public $pageTitle = 'Listado';

    public $columns = [
        [
            'field' => 'id',
            'label' => 'ID',
            'searchable' => false
        ],
        [
            'field' => 'image',
            'label' => 'Imagen',
            'searchable' => true
        ],
        [
            'field' => 'name',
            'label' => 'Categoría',
            'searchable' => true
        ],
        [
            'field' => 'status',
            'label' => 'status',
            'searchable' => true
        ]
    ];

    public $fields = [

        [
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
            'col' => 6,
            'rules' => 'required|min:3',
            'placeholder' => 'Nombre Categoría'
        ],

        [
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'image',
            'col' => 6,
            'rules' => 'nullable|image|max:2048'
        ],

    ];


    // Este hook de Livewire se ejecuta antes de actualizar la propiedad $search
    public function updatingSearch(): void
    {
        $this->resetPage(); // Vuelve a la página 1 automáticamente
    }

    public function render()
    {
        $categories = Categoria::where('name', 'like', "%{$this->search}%")
            ->orderBy('id', 'asc')
            ->paginate(3);
        return view('livewire.categorias.categorias', [
            'categories' => $categories
        ]);
    }

    #[On('formSubmitted')]
    public function saveFromForm($data): void
    {
        //$this->validate();
        $this->name = $data['name'] ?? null;
        $this->image = $data['image'] ?? null;

        //dd($this->name);
        //$this->validate();

        $this->save();
    }

    public function save(): void
    {
        $slug = Str::slug($this->name);

        $imagePath = $this->image_current;

        if ($this->image) {
            if ($this->image_current) {
                Storage::disk('public')->delete($this->image_current);
            }

            $imagePath = $this->image->store('categories', 'public');
        }

        Categoria::updateOrCreate(
            ['id' => $this->category_id],
            [
                'name' => $this->name,
                'slug' => $slug,
                'status' => $this->status,
                'image' => $imagePath,
            ],
        );

        $this->dispatch('category-updated');

        $this->dispatch('closeModal');
        $this->dispatch('notify', message: 'Categoría guardada correctamente');

        $this->resetForm();
    }

    public function edit(Categoria $category): void
    {
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->status = $category->status;
        $this->image_current = $category->image;

        $this->dispatch('showModal');
    }

    #[On('deleterow')]
    public function delete($id): void
    {
        $category = Categoria::find($id);
        if ($category->products()->count() > 0) {
            $this->dispatch('notify', message: 'No puedes eliminar una categoría con productos');
            return;
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        $this->dispatch('notify', message: 'Categoría eliminada');
    }

    public function resetForm(): void
    {
        $this->reset(['name', 'image', 'image_current', 'category_id']);
        $this->status = true;
    }

    #[On('select-search-selected')]
    public function setCategoria($id)
    {
        $this->category_id = $id;
    }
}
