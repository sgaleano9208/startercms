<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Tables;
use App\Models\Appointment;
use App\Models\SalesPerson;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ZoneAppointment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use Filament\Forms\Components\Radio;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-s-collection';
    protected static ?string $activeNavigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Card::make()
                            ->schema([
                                Select::make('goals')
                                    ->options([
                                        1 => 'Goal 1',
                                        2 => 'Goal 2',
                                        3 => 'Goal 3',
                                        4 => 'Goal 4',
                                        5 => 'Goal 5',
                                    ])
                                    ->multiple()
                                    ->searchable()
                                    ->required()
                                    ->columnSpanFull(),
                                RichEditor::make('note')
                                    ->disableAllToolbarButtons()
                                    ->enableToolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'italic',
                                        'link',
                                        'orderedList',
                                    ])
                                    ->columnSpanFull(),
                                Radio::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'done' => 'Done'
                                    ])
                                    ->inline()
                                    ->default('pending')
                            ])
                            ->columns(2)
                            ->columnSpan(2),
                        Card::make()
                            ->schema([
                                Select::make('zone_appointment_id')
                                    // RECUERDA QUE AQUI TENEMOS QUE MOSTRAR SOLO LAS ZONEAPPOINTMENTS QUE ESTEN ACTIVAS Y NO TODAS!!!!
                                    ->relationship('zoneAppointment', 'sales_person_id')
                                    ->reactive()
                                    ->getOptionLabelFromRecordUsing(function ($record) {
                                        return $record->salesPerson->name;
                                    })
                                    ->disabledOn('edit')
                                    ->required(),
                                Select::make('client_id')
                                    ->options(function (Closure $get, $record) {
                                        $salesPerson = ZoneAppointment::find($get('zone_appointment_id'));

                                        if (!$salesPerson) {
                                            return [];
                                        };
                                        return $salesPerson->salesPerson->clients->pluck('name', 'id');
                                    })
                                    ->disabledOn('edit')
                                    ->required(),
                                DatePicker::make('date')
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->minDate(function (Closure $get) {
                                        $zoneAppointment = ZoneAppointment::find($get('zone_appointment_id'));
                                        if (!$zoneAppointment) {
                                            return false;
                                        }
                                        return $zoneAppointment->start_date;
                                    })
                                    ->maxDate(function (Closure $get) {
                                        $zoneAppointment = ZoneAppointment::find($get('zone_appointment_id'));
                                        if (!$zoneAppointment) {
                                            return false;
                                        }
                                        return $zoneAppointment->end_date;
                                    }),
                                TimePicker::make('time')
                                    ->withoutSeconds()
                                    ->required(),
                            ])->columnSpan(1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('time')
                    ->label('Time')
                    ->date('H:i'),
                Tables\Columns\BadgeColumn::make('status')
                    ->enum([
                        'pending' => 'Pending',
                        'done' => 'Done'
                    ])
                    ->icons([
                        'heroicon-s-x-circle',
                        'heroicon-s-check' => 'done',
                    ])
                    ->colors([
                        'warning',
                        'success' => 'done'
                    ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'done' => 'Done'
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AppointmentResource\RelationManagers\ActionPlansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            // 'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
