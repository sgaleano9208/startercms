<?php

namespace App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

use App\Models\Appointment;
use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;

class ClientsRelationManager extends RelationManager
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

                TextInput::make('test')
                ->default('pedro')

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
                    ->action(function (Client $record, Appointment $appointment, array $data, $livewire) {

                        $data['client_id'] = $record->id;
                        $data['zone_appointment_id'] = $livewire->ownerRecord->id;

                        // dd($appointment);

                        $appointment->create($data);
                    })
                    ->form([
                        DatePicker::make('date')
                            ->displayFormat('d/m/Y'),
                        TimePicker::make('time'),
                        FileUpload::make('attachments')
                            ->multiple(),
                        Textarea::make('details'),
                        Radio::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'done' => 'Done'
                            ])->inline()
                    ]),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
