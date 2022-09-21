<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('phone')
                    ->unique(ignoreRecord: true)
                    ->tel(),
                Forms\Components\TextInput::make('email')
                    ->unique(ignoreRecord: true)
                    ->email(),
                Forms\Components\Select::make('area')
                    ->options([
                        'admin' => 'Admin',
                        'admon' => 'Admon',
                        'manager' => 'Manager',
                        'commercial' => 'Commercial',
                        'sales' => 'Sales',
                        'other' => 'Other',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('area')
                    ->enum([
                        'admin' => 'Admin',
                        'admon' => 'Admon',
                        'manager' => 'Manager',
                        'commercial' => 'Commercial',
                        'sales' => 'Sales',
                        'other' => 'Other',
                    ]),
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
