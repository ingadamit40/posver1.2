<div>
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="text-center">Iniciar Sesión <a href="index.html"><span
                                    class="brand-name">{{ $title }}</span></a></h1>

                        <form wire:submit="login()" class="text-left mt-4">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign">
                                        <circle cx="12" cy="12" r="4" />
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94" />
                                    </svg>
                                    <input id="email" wire:model.live="email" type="email" class="form-control"
                                        placeholder="Email">
                                    <div>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Se utiliza la mezcla de alpine js y livewire para realizar la muestra
                                de la contraseña --}}

                                <div x-data="{ show: false }">

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>

                                        <input id="password" wire:model.live="password"
                                            :type="show ? 'text' : 'password'" class="form-control"
                                            placeholder="Password">

                                        <div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-sm-flex justify-content-between">

                                        <div class="field-wrapper toggle-pass">
                                            <p class="d-inline-block">
                                                <span x-text="show ? 'Hide Password' : 'Show Password'"></span>
                                            </p>

                                            <label class="switch s-primary">
                                                <input type="checkbox" x-model="show" class="d-none">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="field-wrapper">
                                            <button type="submit" class="btn btn-primary">
                                                Log In
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>
                        <p class="terms-conditions">© <?php echo date('Y'); ?> All Rights Reserved. <a href="#">Ing
                                Adamit Guillén</a>
                            .</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('login-error', (event) => {

                Swal.fire({
                    icon: 'error',
                    title: 'Acceso denegado',
                    text: event.message,
                    confirmButtonColor: '#d33'
                });

            });
        });
    </script>
</div>
