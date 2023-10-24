<x-form-section submit="medico.update">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- CPF -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cpf" value="{{ __('CPF') }}" />
            <x-input id="cpf" type="text" class="mt-1 block w-full" wire:model.defer="state.cpf" required />
            <x-input-error for="cpf" class="mt-2" />
        </div>

        <!-- RG -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="rg" value="{{ __('RG') }}" />
            <x-input id="rg" type="text" class="mt-1 block w-full" wire:model.defer="state.rg" required />
            <x-input-error for="rg" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="data_nascimento" value="{{ __('Data de Nascimento') }}" />
            <x-input id="data_nascimento" type="date" class="mt-1 block w-full" wire:model.defer="state.data_nascimento" required />
            <x-input-error for="data_nascimento" class="mt-2" />
        </div>

        <!-- CRM -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="crm" value="{{ __('CRM') }}" />
            <x-input id="crm" type="text" class="mt-1 block w-full" wire:model.defer="state.crm" required />
            <x-input-error for="crm" class="mt-2" />
        </div>

        <!-- Especialidade Médica -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="especialidade" value="{{ __('Especialidade Médica') }}" />
            <x-input id="especialidade" type="text" class="mt-1 block w-full" wire:model.defer="state.especialidade" required />
            <x-input-error for="especialidade" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
