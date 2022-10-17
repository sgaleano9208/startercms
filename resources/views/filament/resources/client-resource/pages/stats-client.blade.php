<x-filament::page>

    <div class="grid grid-cols-6 gap-4">

        {{-- PARA MOSTRAR VARIOS WIDGETS... CUSTOM WIDGETS --}}

        {{-- <div x-show='currentTab == "Financiers"' class="tab-pane fade" id="tabs-profile" role="tabpanel"
            aria-labelledby="tabs-profile-tab">

            <x-filament-support::grid default="2" lg="2" class="filament-widgets-container gap-4 lg:gap-8 mb-6">
                @livewire(\App\Filament\Widgets\FinancialIndic::getName())
                @livewire(\App\Filament\Widgets\EvolutionQuotesChart::getName())
                @livewire(\App\Filament\Widgets\EvolutionInvoicesChart::getName())
            </x-filament-support::grid>
        </div> --}}

        <div class="lg:col-span-4 col-span-6">
            {{-- <x-filament::card :heading="$record->name">
                @if ($customWidget = $this->getWidgets())
                <x-filament::widgets :widgets="$customWidget" :columns="1" :data="$widgetData" />
                @endif
            </x-filament::card> --}}
        </div>
        <div class="lg:col-span-2 col-span-6">
            <x-filament::card :heading="$record->name">

                <div class="text-2xl font-bold flex flex-col flex-wrap">
                    <span>YTD Sales:</span>
                    <p class="font-medium text-xl my-3">3450</p>
                </div>
                <x-filament::hr />

            </x-filament::card>
        </div>

        <x-filament::card heading="Tabla" class="col-span-6">
            <div class="grid gap-4 grid-cols-6">
                <div class="lg:col-span-4">

                    prueba

                </div>
                <div class="lg:col-span-2">

                    prueba

                </div>
            </div>

        </x-filament::card>

    </div>

</x-filament::page>
