<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="card-title">
                        <b>{{ $componentName }} | {{ $pageTitle }}</b>
                    </h4>
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                data-target="#theModal">
                                Agregar
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="widget-content mt-4">
                    <livewire:common.data-table model="App\Models\Categoria" :columns="$columns" :perPage="5"
                        refreshEvent="category-updated" />
                </div>
                @include('livewire.categorias.form')
            </div>
        </div>
    </div>
    @script
        <script>
            $wire.on('closeModal', (msg) => {
                $('#theModal').modal('hide')
            });
            $wire.on('showModal', (msg) => {
                $('#theModal').modal('show')
            });
        </script>
    @endscript
    <script>
        document.addEventListener('livewire:init', () => {


            Livewire.on('notify', (event) => {

                // 🔊 Sonido caja registradora


                // 🎉 Notificación SweetAlert2
                const toast = swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'success',
                    title: event.message,
                    padding: '2em',
                })

            });

        });

        function Confirmar(id) {
            Swal.fire({
                title: "Confirmar",
                text: "Estas seguro de eliminar el registro?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cerrar",
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si, eliminar!"
            }).then(function(result) {
                if (result.value) {
                    console.log("se acepto la eliminacion")
                    Livewire.dispatch('deleterow', {
                        id: id
                    })
                    Swal.close()
                }
            })
        }
    </script>
</div>
