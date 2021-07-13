@extends('layouts.main', ['activePage' => 'perfil', 'titlePage' => __('Perfil')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-app-layout>
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
                    @endif
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            @livewire('profile.update-password-form')
                    @endif
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            @livewire('profile.two-factor-authentication-form')
                    @endif
                        @livewire('profile.logout-other-browser-sessions-form')
                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            @livewire('profile.delete-user-form')
                    @endif
                </x-app-layout>
            </div>
        </div>
    </div>
</div>
@endsection
