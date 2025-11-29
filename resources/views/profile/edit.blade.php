<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-3 text-dark">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">

            {{-- FORMULARIO DE PERFIL --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULARIO DE PASSWORD --}}
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
