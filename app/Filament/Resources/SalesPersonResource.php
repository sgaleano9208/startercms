<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\SalesPerson;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SalesPersonResource\Pages;
use App\Filament\Resources\SalesPersonResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;

class SalesPersonResource extends Resource
{
    protected static ?string $model = SalesPerson::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                Grid::make(1)
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->imagePreviewHeight('200')
                            ->loadingIndicatorPosition('right')
                            ->panelAspectRatio('1:1')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('left')
                            ->uploadButtonPosition('right')
                            ->uploadProgressIndicatorPosition('right')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('cod')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->numeric(),
                    ])
                    ->columnSpan(1),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('phone')
                            ->unique(ignoreRecord: true)
                            ->tel()
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('email')
                            ->unique(ignoreRecord: true)
                            ->email()
                            ->columnSpan(1),
                        Forms\Components\Select::make('sales_manager_id')
                            ->options(fn () => User::where('current_team_id', '1')->pluck('name', 'id'))
                            ->searchable()
                            ->label('Sales Manager'),
                        Forms\Components\Select::make('commercial_id')
                            ->options(fn () => User::where('current_team_id', '2')->pluck('name', 'id'))
                            ->searchable()
                            ->label('Commercial'),
                    ])->columnSpan(4)
            ])
            ->columns(5)
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->rounded(),
                Tables\Columns\TextColumn::make('cod'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('salesManager.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesPeople::route('/'),
            'create' => Pages\CreateSalesPerson::route('/create'),
            'edit' => Pages\EditSalesPerson::route('/{record}/edit'),
        ];
    }
}
