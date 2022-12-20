<?php

namespace App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

use Filament\Tables;
use App\Models\Client;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class SalesPersonRelationManager extends RelationManager
{

    protected static string $relationship = 'salesPerson';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [25, 50, 100];
    }

    public static function getTitle(): string
    {
        return 'Clients';
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
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
            ->headerActions([])
            ->actions([
                Tables\Actions\Action::make('create')
                    ->action(function ($record, array $data, $livewire) {

                        $data['client_id'] = $record->id;
                        $data['zone_appointment_id'] = $livewire->ownerRecord->id;

                        $record->appointments()->create($data);
                    })
                    ->form([
                        DatePicker::make('date')
                            ->minDate(fn ($livewire) => $livewire->ownerRecord->start_date)
                            ->maxDate(fn ($livewire) => $livewire->ownerRecord->end_date)
                            ->required(),
                        TimePicker::make('time')
                            ->withoutSeconds()
                            ->required(),
                        Select::make('goals')
                            ->options([
                                'Goal 1',
                                'Goal 2',
                                'Goal 3',
                                'Goal 4',
                                'Goal 5',
                                'Goal 6',
                                'Goal 7',
                            ])
                            ->multiple()
                            ->required(),
                        RichEditor::make('note')
                            ->label('Note')
                            ->disableAllToolbarButtons()
                            ->enableToolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList'
                            ]),
                        Radio::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'done' => 'Done'
                            ])
                            ->inline()
                            ->default('pending')
                    ])
                    ->modalWidth('lg')
                    ->modalHeading('Create Event')
                    ->hidden(fn (Client $record): bool => $record->appointments()->exists()),

                Tables\Actions\Action::make('viewStats')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->label('Stats')
                    // ESTA ES LA SOLUCION PARA GUARDAR EN LA SESSION VALORES.... MUCHO VALOR!!!!
                    ->action(function (Client $record, $livewire) {

                        session()->forget('zoneId');
                        $zoneId = $livewire->ownerRecord->id;
                        session()->put('zoneId', $zoneId);

                        return redirect(route('filament.resources.clients.stats', ['record' => $record]));
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
