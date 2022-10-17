<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{

    protected static string $view = 'app.client.show';

    protected static string $resource = ClientResource::class;

}
