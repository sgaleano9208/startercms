<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ZoneAppointment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
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
                    ->reactive(),
                Forms\Components\Radio::make('status')
                    ->options(['pending' => 'Pending', 'done' => 'Done'])
                    ->default('pending')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->minDate(fn (callable $get) => $get('start_date')),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('salesPerson.avatar')
                    ->size(60)
                    ->rounded()
                    ->grow(false),
                    Stack::make([
                        TextColumn::make('salesPerson.name')
                            ->alignLeft()
                            ->searchable()
                            ->sortable(),
                        TextColumn::make('salesPerson.phone')
                            ->alignLeft()
                            ->icon('heroicon-s-phone'),
                        TextColumn::make('salesPerson.email')
                            ->alignLeft()
                            ->icon('heroicon-s-mail'),
                    ]),
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
                                TextColumn::make('start_date')
                                ->date('d/m/Y')
                                ->icon('heroicon-o-calendar')
                                ->color('success'),
                            TextColumn::make('end_date')
                                ->date('d/m/Y')
                                ->icon('heroicon-o-calendar')
                                ->color('danger'),
                            ]),
                        ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make('view')
                ->button()
                ->color('success')
                ->icon('heroicon-s-collection'),
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
