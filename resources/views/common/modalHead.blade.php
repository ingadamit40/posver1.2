<!-- Modal -->
<div wire:ignore.self class="modal animated zoomInUp custo-zoomInUp" id="theModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    {{ $category_id ? 'Editar' : 'Nueva' }} Categoría
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Por favor espere....
                </h6>
            </div>
            <div class="modal-body">


