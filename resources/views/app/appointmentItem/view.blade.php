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
        <div class="grid grid-cols-2">
            <div class="sm:col-span-1 col-span-full">
                <ul>
                    <li>
                        <x-filament-support::link icon="heroicon-o-phone" size="sm"
                            href="tel:{{$record->salesPerson->phone}}">
                            {{$record->salesPerson->phone}}
                        </x-filament-support::link>
                    </li>
                    <li>
                        <x-filament-support::link icon="heroicon-o-mail" size="sm"
                            href="mailto:{{$record->salesPerson->email}}">
                            {{$record->salesPerson->email}}
                        </x-filament-support::link>
                    </li>

                </ul>
            </div>
            <div class="sm:col-span-1 col-span-full">
                <div>
                    <span class="font-bold text-md">Start date:</span>
                    {{date_format($record->start_date, 'd/m/Y')}}
                </div>
                <div>
                    <span class="font-bold text-md">End date:</span>
                    {{date_format($record->end_date, 'd/m/Y')}}
                </div>
            </div>
            <div class="col-span-full flex flex-wrap items-center pt-2">
                <span class="font-bold text-md">Status:</span>
                <div
                    class="inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight whitespace-nowrap text-warning-700 dark:text-warning-500">
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