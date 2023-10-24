<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('farmacia.register') }}">
            @csrf

            <div class="mb-3">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mb-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mb-3">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mb-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Campos específicos para cadastro de farmácia -->
            <div class="mb-3">
                <x-label for="cnpj" value="{{ __('CNPJ') }}" />
                <x-input id="cnpj" class="form-control" type="text" name="cnpj" :value="old('cnpj')" required />
            </div>

            <div class="mb-3">
                <x-label for="telefone" value="{{ __('Telefone') }}" />
                <x-input id="telefone" class="form-control" type="text" name="telefone" :value="old('telefone')" />
            </div>

            <div class="mb-3">
                <x-label for="celular" value="{{ __('Celular') }}" />
                <x-input id="celular" class="form-control" type="text" name="celular" :value="old('celular')" />
            </div>

            <div class="mb-3">
                <x-label for="cep" value="{{ __('CEP') }}" />
                <x-input id="cep" class="form-control" type="text" name="cep" :value="old('cep')" required />
            </div>

            <div class="mb-3">
                <x-label for="estado" value="{{ __('Estado') }}" />
                <x-input id="estado" class="form-control" type="text" name="estado" :value="old('estado')" required />
            </div>

            <div class="mb-3">
                <x-label for="cidade" value="{{ __('Cidade') }}" />
                <x-input id="cidade" class="form-control" type="text" name="cidade" :value="old('cidade')" required />
            </div>

            <div class="mb-3">
                <x-label for="bairro" value="{{ __('Bairro') }}" />
                <x-input id="bairro" class="form-control" type="text" name="bairro" :value="old('bairro')" required />
            </div>

            <div class="mb-3">
                <x-label for="rua" value="{{ __('Rua') }}" />
                <x-input id="rua" class="form-control" type="text" name="rua" :value="old('rua')" required />
            </div>
            <!-- Fim dos campos específicos para cadastro de farmácia -->

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="form-check mb-3">
                    <x-checkbox name="terms" id="terms" required />
                    <x-label for="terms" class="form-check-label">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </x-label>
                </div>
            @endif

            <div class="d-grid gap-2">
                <x-button>{{ __('Register') }}</x-button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Already registered?') }}</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
