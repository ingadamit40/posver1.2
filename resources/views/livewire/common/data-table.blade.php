<div>

    <!-- BUSCADOR -->
    <div class="d-flex justify-content-between mb-2">

        <input type="text" class="form-control w-25" placeholder="Buscar..." wire:model.live="search">

        <select wire:model.live="perPage" class="form-control w-25">
            <option value="10">10 registros</option>
            <option value="25">25 registros</option>
            <option value="50">50 registros</option>
        </select>

    </div>


    <div class="table-responsive">

        <table class="table table-striped table-hover">

            <thead class="table-dark text-white">

                <tr>

                    @foreach ($columns as $column)
                        <th wire:click="sortBy('{{ $column['field'] }}')" style="cursor:pointer">

                            {{ $column['label'] }}

                            @if ($sortField === $column['field'])
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif

                        </th>
                    @endforeach

                    <th width="150">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $row)

                    <tr>

                        @foreach ($columns as $column)
                            <td>

                                {{-- TIPO TEXTO --}}
                                @if (($column['type'] ?? 'text') === 'text')
                                    {{ $row->{$column['field']} }}
                                @endif


                                {{-- TIPO DINERO --}}
                                @if (($column['type'] ?? '') === 'money')
                                    $ {{ number_format($row->{$column['field']}, 2) }}
                                @endif


                                {{-- BADGE --}}
                                @if (($column['type'] ?? '') === 'badge')
                                    <span class="badge badge-success">

                                        {{ $row->{$column['field']} }}

                                    </span>
                                @endif


                                {{-- IMAGEN --}}
                                @if (($column['type'] ?? '') === 'image')
                                    <img src="{{ asset('storage/' . $row->{$column['field']}) }}" width="40">
                                @endif

                            </td>
                        @endforeach


                        <!-- ACCIONES -->
                        <td>

                            <button class="btn btn-sm btn-warning"
                                wire:click="$dispatch('edit',{id:{{ $row->id }}})">
                                Editar
                            </button>

                            <button class="btn btn-sm btn-danger"
                                wire:click="$dispatch('delete',{id:{{ $row->id }}})">
                                Eliminar
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="10">
                            No hay registros
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="mt-2">
        {{ $data->links() }}
    </div>

</div>
