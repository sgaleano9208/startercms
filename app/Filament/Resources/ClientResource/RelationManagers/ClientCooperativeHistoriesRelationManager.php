<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Tables;
use App\Models\Client;
use Livewire\Component;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\ClientResource\Pages\ViewClient;

class ClientCooperativeHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'clientCooperativeHistories';

/*     public Client $client;

    protected function mount(Client $client){

        $this->client = $client;

    }
 */
    protected static ?string $recordTitleAttribute = 'client';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('cooperative_id')
                ->relationship('cooperative', 'name', function (Builder $query, $livewire) {
                    $query = Client::find($livewire->ownerRecord->id)->cooperatives();
                    return $query;
                })
                ->required()
                ->label('Cooperatives')
                ->columnSpan('full'),
                DatePicker::make('start_date')
                ->displayFormat('d/m/Y')
                ->closeOnDateSelection(),
                DatePicker::make('end_date')
                ->displayFormat('d/m/Y')
                ->closeOnDateSelection(),
                Textarea::make('observation')
                ->maxLength(255)
                ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cooperative.name'),
                Tables\Columns\TextColumn::make('start_date')
                ->formatStateUsing(fn($state) => (!$state) ? '-' : Carbon::parse($state)->format('d/m/Y')),
                Tables\Columns\TextColumn::make('end_date')
                ->formatStateUsing(fn($state) => (!$state) ? 'To date' : Carbon::parse($state)->format('d/m/Y')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
                Tables\Actions\DeleteAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ]);
    }
}
