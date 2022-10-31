<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use App\Models\Appointment;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ZoneAppointment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ZoneAppointmentResource\Pages;
use App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

class ZoneAppointmentResource extends Resource
{
    protected static ?string $model = ZoneAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sales_person_id')
                    ->relationship('salesPerson', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->reactive()
                    ->closeOnDateSelection()
                    /* ->rules([
                        function () {
                            return function ($state) {
                                $existsActive = ZoneAppointment::where(function ($query) use ($state) {
                                    $query->where('start_date', '<=', $state);
                                    $query->where('end_date', '>=', $state);
                                })->count();
                                if ($existsActive > 0) {
                                    dd('bloqueada');
                                }
                            };
                        },
                    ]) */,

                Forms\Components\Radio::make('status')
                    ->options(['pending' => 'Pending', 'done' => 'Done'])
                    ->default('pending')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->minDate(fn (callable $get) => $get('start_date'))
                    ->closeOnDateSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('salesPerson.photo')
                        ->size(60)
                        ->rounded()
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
                            ->formatStateUsing(function ($state) {
                                $clients = Client::find($state->pluck('client_id'));
                                return $clients->pluck('name');
                            })
                            ->view('table.column.appointmentClients')

                    ]),
                ])->collapsible(),
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
