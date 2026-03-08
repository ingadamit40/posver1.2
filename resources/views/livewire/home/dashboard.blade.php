<div>
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('show-welcome', (event) => {

                // 🔊 Sonido caja registradora
                //let audio = new Audio('/sounds/caja-registradora.mp3');
                //audio.play();

                // 🎉 Notificación SweetAlert2
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'success',
                    title: 'Bienvenido ' + event.name + ' 🛒',
                    padding: '2em',
                })

            });

        });
    </script>
</div>
