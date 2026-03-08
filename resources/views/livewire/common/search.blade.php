<div class="row justify-content-between">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="position-relative">

            <input type="text" class="form-control" wire:model.live="search" placeholder="Buscar...">

            @if (count($results) > 0)
                <div class="list-group position-absolute w-100 shadow" style="z-index:1000">

                    @foreach ($results as $item)
                        <a href="#" wire:click.prevent="selectItem({{ $item->id }}, '{{ $item->$field }}')"
                            class="list-group-item list-group-item-action">

                            {{ $item->$field }}

                        </a>
                    @endforeach

                </div>
            @endif

        </div>

    </div>
</div>
