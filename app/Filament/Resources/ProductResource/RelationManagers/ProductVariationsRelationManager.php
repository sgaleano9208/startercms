<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Color;
use App\Models\Size;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProductVariationsRelationManager extends RelationManager
{
    protected static string $relationship = 'productVariations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                /* Forms\Components\TextInput::make('name')
                ->disabled()
                ->default(fn($livewire) => $livewire->ownerRecord->ref)
                ->columnSpan('full'), */
                Forms\Components\Select::make('color_id')
                ->relationship('color', 'name')
                /* ->reactive()
                ->afterStateUpdated(function(callable $set, $state, $livewire){
                    $originalName = $livewire->ownerRecord->ref;
                    $colName = Color::where('id', $state)->pluck('name');
                    $set('name', null);
                    $set('name', $originalName.'-'.$colName->implode(','));
                }) */,
                Forms\Components\Select::make('size_id')
                ->relationship('size', 'name')
                /* ->reactive()
                ->afterStateUpdated(function(callable $set, callable $get, $state, $livewire){
                    $originalName = $livewire->ownerRecord->ref;
                    $sizeName = Size::where('id', $state)->pluck('name');
                    if(!$get('color_id')){
                        $set('name', null);
                        $set('name', $originalName.'-'.$sizeName->implode(','));
                    }
                    $colName = Color::where('id', $get('color_id'))->pluck('name');
                    $set('name', null);
                    $set('name', $originalName.'-'.$colName->implode(',').'-'.$sizeName->implode(','));
                }) */,
                Forms\Components\TextInput::make('price')
                ->numeric()
                ->mask(fn (Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ',', decimalPlaces: 2))
                ->lazy()
                ->afterStateUpdated(fn(callable $set, $state) => $set('incomplete_price', (($state * 0.7) + $state))),

                Forms\Components\TextInput::make('units')
                ->numeric()
                ->minValue(0),

                Forms\Components\TextInput::make('min_qty')
                ->label('Min. Qty')
                ->numeric()
                ->minValue(0),

                Forms\Components\TextInput::make('incomplete_price')
                ->label('Incomplete box price')
                ->numeric()
                ->mask(fn (Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ',', decimalPlaces: 2)),

                Forms\Components\Radio::make('status')
                ->inline()
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->default('active'),

                Forms\Components\Toggle::make('to_order')
                ->onIcon('heroicon-s-lightning-bolt')
                ->offIcon('heroicon-s-user')
                ->onColor('warning')
                ->offColor('success')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('incomplete_price'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('min_qty'),
                Tables\Columns\TextColumn::make('units'),
                Tables\Columns\IconColumn::make('to_order')
                ->options([
                    'heroicon-o-x-circle',
                    'heroicon-o-pencil' => false,
                ])
                ->colors([
                    'success',
                    'danger' => false,
                ]),
                Tables\Columns\BadgeColumn::make('status')
                ->enum([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->colors([
                    'success',
                    'danger' => 'inactive'
                ])
                ->icons([
                    'heroicon-o-check',
                    'heroicon-o-x-circle' =>'inactive'
                ])
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['name'] = 'lo que quiera';

                    dd($data);

                    return $data;
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
