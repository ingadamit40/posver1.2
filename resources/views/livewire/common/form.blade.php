<div>
    <form wire:submit.prevent="submit">

        <div class="row">

            @foreach ($fields as $field)
                <div class="col-md-{{ $field['col'] ?? 12 }} mb-3">

                    <label class="form-label">
                        {{ $field['label'] }}
                    </label>

                    {{-- INPUT TEXT --}}
                    @if ($field['type'] == 'text')
                        <input type="text" class="form-control" wire:model="data.{{ $field['name'] }}">
                    @endif


                    {{-- NUMBER --}}
                    @if ($field['type'] == 'number')
                        <input type="number" class="form-control" wire:model="data.{{ $field['name'] }}">
                    @endif


                    {{-- SELECT --}}
                    @if ($field['type'] == 'select')
                        <select class="form-control" wire:model="data.{{ $field['name'] }}">

                            <option value="">Seleccione</option>

                            @foreach ($field['options'] as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>
                    @endif


                    {{-- TEXTAREA --}}
                    @if ($field['type'] == 'textarea')
                        <textarea class="form-control" wire:model="data.{{ $field['name'] }}"></textarea>
                    @endif


                    {{-- FILE --}}
                    @if ($field['type'] == 'file')
                        <input type="file" class="form-control" wire:model="data.{{ $field['name'] }}">
                    @endif

                </div>
            @endforeach

        </div>

        <button class="btn btn-primary">
            Guardar
        </button>

    </form>
</div>
