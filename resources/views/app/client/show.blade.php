<x-filament::page :widget-data="['record' => $record]" :class="\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-view-record-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'filament-resources-record-' . $record->getKey(),
    ])">
    @php
    $relationManagers = $this->getRelationManagers();
    @endphp

    {{-- @if ((! $this->hasCombinedRelationManagerTabsWithForm()) || (! count($relationManagers)))
    {{ $this->form }}
    @endif --}}
    <div class="w-full grid grid-cols-6 gap-4">
        <x-filament::card :heading="$record->name" class="sm:col-span-2 col-span-full">
            <ul>
                <li>
                    <x-filament-support::link icon="heroicon-o-phone" size="sm" href="tel:{{$record->phone}}">
                        {{$record->phone}}
                    </x-filament-support::link>
                </li>
                <li>
                    <x-filament-support::link icon="heroicon-o-mail" size="sm" href="mailto:{{$record->email}}">
                        {{$record->email}}
                    </x-filament-support::link>
                </li>
                <li>
                    <strong>VAT:</strong> {{$record->vat}}
                </li>
                <li>
                    <strong>Nº nav:</strong> {{$record->no_nav}}
                </li>
            </ul>
            <div>
                <div class="col-span-1">
                    <span class="block font-bold text-md">Status:</span>

                    {{$record->status}}
                </div>
                <div class="col-span-1">
                    <span class="block font-bold text-md">Type:</span>
                    {{$record->type}}
                </div>
            </div>
        </x-filament::card>
        <x-filament::card :heading="('Details')" class="sm:col-span-4 col-span-full">
            <div class="grid sm:grid-cols-2 grid-cols-1">
                <div class="col-span-2 py-3">
                    <span class="block font-bold text-md">Address:</span>
                    {{$record->address}} a
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Country:</span>
                    {!! !empty($record->country->name) ? $record->country->name : '-' !!}
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">State:</span>
                    {!! !empty($record->state->name) ? $record->state->name : '-' !!}
                </div>
                <div class="col-span-2 py-3">
                    <x-filament::hr class="py-3" />
                    <span class="block font-bold text-md">Cooperatives:</span>
                    <ul class="py-3">
                        @forelse ($record->cooperatives as $cooperative)
                        <li>{{$cooperative->name}}</li>
                        @empty
                            -
                        @endforelse
                    </ul>
                    <x-filament::hr />
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Typology:</span>
                    {!! !empty($record->typology->name) ? $record->typology->name : '-' !!}
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Sales Person:</span>
                    {{$record->address}} a
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Commercial:</span>
                    {{$record->address}} a
                </div>
            </div>
            <x-filament::hr />
        </x-filament::card>
    </div>

    @if (count($relationManagers))
    @if (! $this->hasCombinedRelationManagerTabsWithForm())
    <x-filament::hr />
    @endif

    <x-filament::resources.relation-managers :active-manager="$activeRelationManager"
        :form-tab-label="$this->getFormTabLabel()" :managers="$relationManagers" :owner-record="$record"
        :page-class="static::class">
        @if ($this->hasCombinedRelationManagerTabsWithForm())
        <x-slot name="form">
            {{ $this->form }}
        </x-slot>
        @endif
    </x-filament::resources.relation-managers>
    @endif
</x-filament::page>
