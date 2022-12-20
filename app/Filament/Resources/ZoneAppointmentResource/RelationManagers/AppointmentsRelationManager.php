<?php

namespace App\Filament\Resources\ZoneAppointmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Appointment;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    protected static ?string $recordTitleAttribute = 'client_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([

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

            ]);
    }

    public function plan()
    {
        session()->forget('appointmentId');
        $appointmentId = $this->record->id;
        session()->put('appointmentId', $appointmentId);
        debug($appointmentId);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name'),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y'),
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
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(fn (?Model $record) => 'Edit Appointment for ' . $record->client->name)
                    ->modalActions([
                        Forms\Components\Actions\Modal\Actions\Action::make('submit')
                            ->label('Submit')
                            ->submit()
                            ->color('success')
                            ->icon('heroicon-s-pencil'),
                        Forms\Components\Actions\Modal\Actions\Action::make('cancel')
                            ->label('Cancel')
                            ->cancel()
                            ->color('secondary'),
                    ])
                    ->modalWidth('md'),
                Tables\Actions\Action::make('plan')
                    ->action(function (?Model $record) {
                        session()->forget('appointmentId');
                        $appointmentId = $record->id;
                        session()->put('appointmentId', $appointmentId);
                        debug($appointmentId);
                        redirect(route('filament.resources.action-plans.create'));
                    }),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
