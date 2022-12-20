<?php

namespace App\Filament\Resources\AppointmentResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActionPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'actionPlans';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([

                        Forms\Components\Builder::make('actions')
                        ->blocks([
                            Forms\Components\Builder\Block::make('content')
                            ->schema([
                                Forms\Components\TextInput::make('heading')
                                ->required()
                            ])
                        ])->disableItemMovement()
                            ->required(),
                        Forms\Components\Radio::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'closed' => 'Closed'
                            ])
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('actions'),
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
