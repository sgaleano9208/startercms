<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;

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
                Tables\Columns\TextColumn::make('phone')
                ->url(fn(Model $record) => 'tel:'.$record->phone),
                Tables\Columns\TextColumn::make('email')
                ->url(fn(Model $record) => 'mailto:'.$record->email),
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
                Tables\Actions\CreateAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
                Tables\Actions\DeleteAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ]);
    }
}
