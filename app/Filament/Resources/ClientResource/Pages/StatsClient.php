<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Models\Client;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\ClientResource;

class StatsClient extends Page
{
    public Client $record;

    public $widgetData;

    public $customWidget;

    public $zoneId;

    public function mount(): void
    {
        $this->zoneId = session()->get('zoneId');
        debug($this->zoneId);
        $this->widgetData = [ 'id' => $this->record->id ];
    }

    protected static string $resource = ClientResource::class;

    protected static string $view = 'filament.resources.client-resource.pages.stats-client';

    protected function getActions(): array
    {
        return [
            Action::make('back')
            ->link()
            ->color('gray')
            ->icon('heroicon-s-arrow-left')
            ->url(fn(): string => route('filament.resources.zone-appointments.view', ['record' => $this->zoneId])),
        ];
    }

    protected function getWidgets(): array
    {
        return [
            ClientResource\Widgets\ClientStatsChart::class,
        ];
    }


}
