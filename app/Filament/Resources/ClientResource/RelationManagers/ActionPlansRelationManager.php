<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActionPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'actionPlans';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Builder::make('actions')
                ->disableLabel()
                ->disableItemMovement()
                ->blocks([
                    Forms\Components\Builder\Block::make('note')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                        ->disableAllToolbarButtons()
                        ->enableToolbarButtons([
                            'bold',
                            'italic',
                        ])
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function ($livewire) {
                        return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                    }),
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
