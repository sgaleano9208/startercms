<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Exception;
use Filament\Forms;
use App\Models\Size;
use Filament\Tables;
use App\Models\Color;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
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
                Forms\Components\Select::make('color_id')
                    ->relationship('color', 'name')
                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "$record->code - $record->name")
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('size_id')
                    ->relationship('size', 'code')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->lazy()
                    ->afterStateUpdated(fn(callable $set, $state) => $set('incomplete_price', (($state * 0.07) + $state))),

                Forms\Components\TextInput::make('units')
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('min_qty')
                    ->label('Min. Qty')
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('incomplete_price')
                    ->label('Incomplete box price')
                    ->numeric(),

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

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('incomplete_price')
                    ->label('Inc.price'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('min_qty')
                    ->label('Min.Qty'),
                Tables\Columns\TextColumn::make('units'),
                Tables\Columns\ToggleColumn::make('to_order')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-o-check-circle')
                    ->onColor('primary')
                    ->offColor('danger'),
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
                        'heroicon-o-x-circle' => 'inactive'
                    ])
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data, $livewire): array {

                        return self::getNameFromColorAndSize($livewire, $data);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, $livewire): array {

                        return self::getNameFromColorAndSize($livewire, $data);
                    }),
                Tables\Actions\ReplicateAction::make()
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('color_id')
                                    ->relationship('color', 'name')
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "$record->code - $record->name")
                                    ->searchable(),

                                Forms\Components\Select::make('size_id')
                                    ->relationship('size', 'code')
                                    ->searchable(),

                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->lazy()
                                    ->afterStateUpdated(fn(callable $set, $state) => $set('incomplete_price', (($state * 0.07) + $state))),

                                Forms\Components\TextInput::make('incomplete_price')
                                    ->label('Incomplete box price')
                                    ->numeric(),

                                Forms\Components\TextInput::make('units')
                                    ->numeric()
                                    ->minValue(0),

                                Forms\Components\TextInput::make('min_qty')
                                    ->label('Min. Qty')
                                    ->numeric()
                                    ->minValue(0),

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
                            ])
                    ])
                    ->beforeReplicaSaved(function (Model $replica, array $data, $livewire): void {
                        $replica->fill($data);
                        $data = self::getNameFromColorAndSize($livewire, $data);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('update')
                    ->action(function (Collection $records, array $data): void {
                        //LA FUNCION ARRAY_FILTER LIMPIA LOS DATOS VACIOS DEL ARRAY.
//                        dd($data);
                        $records->each->update(array_filter($data));
                        /*  foreach($records as $record) {
                        $record->save($data);
                    } */
                    })
                    ->form([

                        Forms\Components\Radio::make('status')
                            ->inline()
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ]),

                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->lazy()
                            ->afterStateUpdated(fn(callable $set, $state) => $set('incomplete_price', (($state * 0.07) + $state))),

                        Forms\Components\TextInput::make('units')
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('min_qty')
                            ->label('Min. Qty')
                            ->numeric()
                            ->minValue(0),

                    ])
                    ->label('Update selected')
                    ->icon('heroicon-s-pencil')
                    ->deselectRecordsAfterCompletion()

            ]);
    }

    /**
     * @param $livewire
     * @param array $data
     * @return array
     */
    private static function getNameFromColorAndSize($livewire, array $data): array
    {
        $productName = $livewire->ownerRecord->ref;

        if ($data['color_id']) {
            $colorName = Color::where('id', $data['color_id'])->first();
            $productName .= '-' . $colorName->code;
        }

        if ($data['size_id']) {
            $sizeName = Size::where('id', $data['size_id'])->first();
            $productName .= '-' . $sizeName->code;
        }

        $data['name'] = $productName;
        return $data;
    }
}
