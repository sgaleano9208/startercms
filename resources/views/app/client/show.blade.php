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
            <div>
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
                <x-filament::hr />
            </div>
            <div class="grid grid-cols-2 w-full gap-3">
                <div class="col-span-1">
                    <span class="block font-bold text-md">Status:</span>
                    @if ($record->status != 'active')
                    <div
                        class="inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 py-0.5 font-medium tracking-tight whitespace-nowrap text-danger-700 dark:text-danger-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>
                            {{ucfirst($record->status)}}
                        </span>
                    </div>
                    @else
                    <div
                        class="inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 py-0.5 font-medium tracking-tight whitespace-nowrap text-success-700 dark:text-success-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>
                            {{ucfirst($record->status)}}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="col-span-1">
                    <span class="block font-bold text-md">Type:</span>
                    <div
                        class="inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 py-0.5 font-medium tracking-tight  whitespace-nowrap text-primary-700 dark:text-primary-500">

                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>
                            {{ucfirst($record->type)}}
                        </span>
                    </div>
                </div>

                <div class="col-span-1">
                    <span class="block font-bold text-md">Nº nav:</span>
                    {{$record->no_nav}}
                </div>

                <div class="col-span-1">
                    <span class="block font-bold text-md">VAT.</span>
                    {{$record->vat}}
                </div>

                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Typology:</span>
                    {!! !empty($record->typology->name) ? $record->typology->name : '-' !!}
                </div>
                
            </div>
        </x-filament::card>
        <x-filament::card :heading="('Details')" class="sm:col-span-4 col-span-full">
            <div class="grid sm:grid-cols-2 grid-cols-1">
                {{-- <div class="col-span-2 py-3">
                    <span class="block font-bold text-md">Address:</span>
                    Direccion a futuro....
                </div> --}}
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
                    <span class="block font-bold text-md">Sales Person:</span>
                    {!! !empty($record->salesPerson->name) ? $record->salesPerson->name : '-' !!}
                </div>
                <div class="col-span-1 py-3">
                    <span class="block font-bold text-md">Commercial:</span>
                    {!! !empty($record->salesPerson->commercial_id) ? $record->salesPerson->commercial->name : '-' !!}
                </div>
            </div>
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