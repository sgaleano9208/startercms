<?php

namespace App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

use App\Filament\Resources\ClientResource;
use Filament\Tables;
use App\Models\Client;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SalesPersonRelationManager extends RelationManager
{

    protected static string $relationship = 'salesPerson';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return Client::where('sales_person_id', $this->ownerRecord->sales_person_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([

                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\Action::make('create')
                    ->action(function ($record, array $data, $livewire) {

                        $data['client_id'] = $record->id;
                        $data['zone_appointment_id'] = $livewire->ownerRecord->id;

                        // dd($record->appointments());

                        $record->appointments()->create($data);
                    })
                    ->form([
                        DatePicker::make('date')
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection(),
                        TimePicker::make('time')
                        ->withoutSeconds(),
                        // FileUpload::make('attachments')
                        //     ->multiple(),
                        Textarea::make('details'),
                        Radio::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'done' => 'Done'
                            ])->inline()
                    ])
                    ->hidden(fn(Client $record):bool => $record->appointments()->exists()),

                Tables\Actions\Action::make('viewStats')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->label('Stats')
                // ESTA ES LA SOLUCION PARA GUARDAR EN LA SESSION VALORES.... MUCHO VALOR!!!!
                ->action(function(Client $record, $livewire) {

                    session()->forget('zoneId');
                    $zoneId = $livewire->ownerRecord->id;
                    session()->put('zoneId', $zoneId);

                    return redirect(route('filament.resources.clients.stats', ['record' => $record]));

                }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

}
