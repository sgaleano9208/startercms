<?php

namespace App\Filament\Resources\AppointmentResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\ActionPlan;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class ActionPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'actionPlans';

    //    protected static ?string $recordTitleAttribute = 'id';

    public function exportPdf(?Model $record)
    {

        // return redirect(route('pdf', ['record' => $record]));

        $pdf = Pdf::loadView('app.action-plan.pdf-export', ['record' => $record])->output();
        return response()->streamDownload(fn () => print($pdf), 'test.pdf');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('client_id')
                            ->default(fn ($livewire) => $livewire->ownerRecord->client_id)
                            ->hidden(),
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\DatePicker::make('date')
                            ->withoutTime(),
                        Forms\Components\RichEditor::make('note')
                            ->disableAllToolbarButtons()
                            ->enableToolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                            ]),
                        TableRepeater::make('offer')
                            ->schema([
                                Forms\Components\Select::make('product')
                                    ->options(ProductVariation::all()->pluck('name', 'id'))
                                    ->disableLabel()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Closure $set) {
                                        $product = ProductVariation::where('id', $state)->first();
                                        if (!$product) {
                                            return null;
                                        }
                                        return $set('currentPrice', $product->price) && $set('productName', $product->name);
                                    }),
                                Forms\Components\TextInput::make('productName')
                                ->hidden(),
                                Forms\Components\TextInput::make('currentPrice')
                                    ->placeholder("Select a product to load it's price")
                                    ->disabled()
                                    ->disableLabel(),
                                Forms\Components\TextInput::make('discount')
                                ->disabled()
                                ->disableLabel()
                                ->reactive()
                                ->extraInputAttributes(function($state):array {
                                    if($state > 55)
                                    {
                                        return [
                                            'class' => 'text-red-400',
                                        ];
                                    }
                                    return [];
                                }),
                                Forms\Components\TextInput::make('offerPrice')
                                    ->disableLabel()
                                    ->numeric()
                                    ->minValue(0)
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(function(Closure $set, $get, $state){

                                            $discount = (($get('currentPrice') - $state) / $get('currentPrice')) * 100;

                                            /* if($discount > 55){
                                                dd('El descuento es mayor a 55% - '. round($discount, 2));
                                            } */

                                            return $set('discount', round($discount, 2));
                                    })
                            ])
                            ->disableItemMovement()
                            ->createItemButtonLabel('Add new product')
                            ->hint('Select the products to offer')
                            ->hintIcon('heroicon-o-information-circle'),
                        Forms\Components\Radio::make('status')
                            ->options([
                                'started' => 'Started',
                                'finished' => 'Finished',
                            ])
                            ->inline()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('date')
                ->date('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data, $livewire) {
                        $data['client_id'] = $livewire->ownerRecord->client_id;

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('exportPdf')
                    ->action('exportPdf'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
