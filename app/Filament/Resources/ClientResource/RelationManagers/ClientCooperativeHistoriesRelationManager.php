<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Livewire\Livewire;
use App\Models\Cooperative;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

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
                ->label('Cooperatives'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cooperative.name'),
                Tables\Columns\TextColumn::make('start_date')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('end_date')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('observation'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
