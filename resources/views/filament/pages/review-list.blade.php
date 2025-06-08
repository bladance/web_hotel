<x-filament-panels::page>
    <x-filament::card>
        {{ $this->form }}
    </x-filament::card>
    @if ($this->hotel)
        <x-filament::card class="mt-6">
            {{ $this->table }}
        </x-filament::card>
    @endif
</x-filament-panels::page>
