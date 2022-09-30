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
        <x-filament::card :heading="$record->salesPerson->name">
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

            </ul>
            <div>
                <div class="col-span-1">
                    <span class="block font-bold text-md">Status:</span>

                    {{$record->status}}
                </div>
            </div>
        </x-filament::card>

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
