<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ZoneAppointment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ZoneAppointmentResource\Pages;
use App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

class ZoneAppointmentResource extends Resource
{
    protected static ?string $model = ZoneAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar';
    protected static ?string $activeNavigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Forms\Components\Select::make('sales_person_id')
                            ->relationship('salesPerson', 'name')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpan('full'),
                            Forms\Components\DatePicker::make('start_date')
                            ->displayFormat('d/m/Y')
                            ->required()
                            ->reactive()
                            ->closeOnDateSelection()
                            ->rules([
                                function ($record) {
                                    return function (string $attribute, $value, Closure $fail) use ($record) {
                                        $existsActive = ZoneAppointment::where(function ($query) use ($value) {
                                            $query->where('start_date', '<=', $value);
                                            $query->where('end_date', '>=', $value);    
                                        })->count();
                                        $currentRecord = ZoneAppointment::find($record);

                                        if ($existsActive > 0 and !$currentRecord) {
                                            $fail("Date range already selected");
                                        }
                                    };
                                },
                            ]),
                        Forms\Components\DatePicker::make('end_date')
                            ->displayFormat('d/m/Y')
                            ->required()
                            ->minDate(fn (callable $get) => $get('start_date'))
                            ->closeOnDateSelection()
                            ->rules([
                                function ($record) {
                                    return function (string $attribute, $value, Closure $fail) use ($record) {
                                        $existsActive = ZoneAppointment::where(function ($query) use ($value) {
                                            $query->where('start_date', '<=', $value);
                                            $query->where('end_date', '>=', $value);    
                                        })->count();
                                        $currentRecord = ZoneAppointment::find($record);

                                        if ($existsActive > 0 and !$currentRecord) {
                                            $fail("Date range already selected");
                                        }
                                    };
                                },
                            ]),
                        Forms\Components\Radio::make('status')
                            ->options(['pending' => 'Pending', 'done' => 'Done'])
                            ->default('pending')
                            ->required()
                            ->inline(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('salesPerson.photo')
                        ->size(60)
                        ->circular()
                        ->grow(false),
                    Stack::make([
                        TextColumn::make('salesPerson.name')
                            ->alignLeft()
                            ->searchable()
                            ->sortable(),
                        TextColumn::make('start_date')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-calendar')
                            ->color('success'),
                        TextColumn::make('end_date')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-calendar')
                            ->color('danger'),
                    ]),
                    Stack::make([
                        TextColumn::make('salesPerson.phone')
                            ->alignLeft()
                            ->icon('heroicon-s-phone'),
                        TextColumn::make('salesPerson.email')
                            ->alignLeft()
                            ->icon('heroicon-s-mail'),
                    ])->visibleFrom('md'),
                    BadgeColumn::make('status')
                        ->enum(['pending' => 'Pending', 'done' => 'Done'])
                        ->colors([
                            'success',
                            'warning' => 'pending'
                        ])
                        ->icons([
                            'heroicon-s-check',
                            'heroicon-s-x-circle' => 'pending'
                        ])
                        ->alignRight(),
                ]),
                Panel::make([
                    Stack::make([
                        TextColumn::make('appointments')
                            /* ->formatStateUsing(function ($state) {
                                $clients = Client::find($state->pluck('client_id'));
                                return $clients->pluck('name');
                            }) */
                            ->view('table.column.appointmentClients')

                    ]),
                ])
                ->collapsible()
                ->hidden(function(?Model $record){
                    $appointments = ZoneAppointment::find($record->id);
                    $appointments = $appointments->appointments()->count();

                    
                    if($appointments > 0){
                        return false;
                    }
                    return true;
                    
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ZoneAppointmentResource\RelationManagers\SalesPersonRelationManager::class,
            ZoneAppointmentResource\RelationManagers\AppointmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZoneAppointments::route('/'),
            // 'create' => Pages\CreateZoneAppointment::route('/create'),
            // 'edit' => Pages\EditZoneAppointment::route('/{record}/edit'),
            'view' => Pages\ViewZoneAppointment::route('/{record}/view'),
            'calendar' => Pages\AppointmentCalendar::route('/calendar')
        ];
    }
}
