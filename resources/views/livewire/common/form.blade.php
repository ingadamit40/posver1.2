<div>

    <form wire:submit.prevent="submit">

        <div class="row">

            @foreach ($fields as $field)

                <div class="col-md-{{ $field['col'] ?? 12 }} mb-3">

                    <label class="form-label">
                        {{ $field['label'] }}
                    </label>

                    {{-- TEXT --}}
                    @if ($field['type'] == 'text')
                        <input type="text" {{-- .live valida al perder el foco --}} wire:model.live="data.{{ $field['name'] }}"
                            class="form-control @error('data.' . $field['name']) is-invalid @enderror"
                            placeholder="{{ $field['placeholder'] ?? '' }}">
                    @endif


                    {{-- NUMBER --}}
                    @if ($field['type'] == 'number')
                        <input type="number" {{-- .live valida al perder el foco --}} wire:model.live="data.{{ $field['name'] }}"
                            class="form-control @error('data.' . $field['name']) is-invalid @enderror"
                            wire:model="data.{{ $field['name'] }}">
                    @endif


                    {{-- TEXTAREA --}}
                    @if ($field['type'] == 'textarea')
                        <textarea {{-- .live valida al perder el foco --}} wire:model.live="data.{{ $field['name'] }}"
                            class="form-control @error('data.' . $field['name']) is-invalid @enderror" wire:model="data.{{ $field['name'] }}"></textarea>
                    @endif


                    {{-- SELECT --}}
                    @if ($field['type'] == 'select')
                        <select {{-- .live valida al perder el foco --}} wire:model.live="data.{{ $field['name'] }}"
                            class="form-control @error('data.' . $field['name']) is-invalid @enderror"
                            wire:model="data.{{ $field['name'] }}">

                            <option value="">Seleccione</option>

                            @foreach ($field['options'] as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>
                    @endif


                    {{-- IMAGE --}}
                    @if ($field['type'] == 'image')
                        <input {{-- .live valida al perder el foco --}} wire:model.live="data.{{ $field['name'] }}" type="file"
                            class="form-control @error('data.' . $field['name']) is-invalid @enderror"
                            wire:model="data.{{ $field['name'] }}" accept="image/*">

                        @if (isset($data[$field['name']]) && $data[$field['name']])
                            <div class="mt-2">

                                @if (is_object($data[$field['name']]))
                                    <img src="{{ $data[$field['name']]->temporaryUrl() }}" class="img-thumbnail"
                                        style="max-height:120px">
                                @else
                                    <img src="{{ Storage::url($data[$field['name']]) }}" class="img-thumbnail"
                                        style="max-height:120px">
                                @endif

                            </div>
                        @endif
                    @endif


                    {{-- MENSAJE ERROR --}}
                    @error('data.' . $field['name'])
                        <div class="invalid-feedback"> {{-- Bootstrap usa esta clase para el estilo --}}
                            {{ $message }}
                        </div>
                    @enderror


                </div>

            @endforeach

        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            {{-- Botón Cancelar/Cerrar --}}
            <button type="button" class="btn btn-secondary" wire:click="resetForm()" data-dismiss="modal">
                {{-- Esto cierra el modal de Bootstrap --}}
                Cancelar
            </button>

            {{-- Tu botón de Guardar existente --}}
            <button type="submit" class="btn btn-dark close-modal" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    {{ isset($data['id']) ? 'Actualizar' : 'Guardar' }}
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm"></span>
                </span>
            </button>
        </div>

    </form>

</div>
