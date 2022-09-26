<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use App\Models\Promotion;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ProductVariation;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PromotionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\PromotionResource\RelationManagers;
use App\Models\Proposal;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('client_id')
                            ->options(fn () => Client::all()->where('status', 'active')->pluck('name', 'id'))
                            ->required()
                            ->preload()
                            ->label('Client')
                            ->searchable(),
                        DatePicker::make('start_date')
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                        DatePicker::make('end_date')
                            ->minDate(fn (callable $get) => $get('start_date')),
                        DatePicker::make('first_order_date')
                            ->displayFormat('d/m/Y'),
                        Radio::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active'),
                        Textarea::make('observation')
                            ->columnSpan('full'),
                    ])
                    ->columns(2),
                Card::make()
                    ->schema([
                        Repeater::make('promotionItems')
                            ->relationship('promotionItems')
                            ->schema([
                                Select::make('product_variation_id')
                                    ->options(fn () => ProductVariation::all()->where('status', 'active')->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function(callable $set, $state) {
                                        $product = ProductVariation::find($state);
                                        if($product){
                                        $set('name', $product->name);
                                        $set('price', $product->price);
                                        }
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->label('Product'),
                                TextInput::make('name'),
                                TextInput::make('promo_price')
                                    ->numeric(),
                                TextInput::make('discount')
                                    ->numeric(),
                                TextInput::make('price')
                                    ->numeric(),
                                TextInput::make('current_sales')
                                    ->numeric(),
                                TextInput::make('past_sales')
                                    ->numeric(),
                                Toggle::make('is_selected')
                            ])
                            ->columns(8)
                            ->createItemButtonLabel('Add new line')
                            ->defaultItems(0)
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->searchable()
                    ->sortable()
                    ->date('d/m/Y'),
                TextColumn::make('end_date')
                    ->searchable()
                    ->sortable()
                    ->date('d/m/Y'),
                BadgeColumn::make('status')
                    ->enum([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->colors([
                        'success',
                        'danger' => 'inactive'
                    ])
                    ->icons([
                        'heroicon-s-check-circle',
                        'heroicon-s-x-circle' => 'inactive'
                    ])

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ReplicateAction::make()
                    ->action(function(Promotion $record, array $data){
                        $replica = $record->duplicate();
                        $replica->fill($data);
                        $replica->save();
                    })
                    ->form([
                        TextInput::make('name')->required(),
                    ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
