<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Family;
use Livewire\Livewire;
use App\Models\Competitor;
use App\Models\DropReason;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ClientSalesDrop;
use App\Models\ProductVariation;
use Filament\Resources\Resource;
use App\Models\ClientSalesDropDetail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientSalesDropResource\Pages;
use App\Filament\Resources\ClientSalesDropResource\RelationManagers;

class ClientSalesDropResource extends Resource
{
    protected static ?string $model = ClientSalesDrop::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name'),
                BooleanColumn::make('_reported'),

            ])
            ->filters([

                //
            ])
            ->actions([
                Tables\Actions\Action::make('editCreate')
                    ->mountUsing(fn (Forms\ComponentContainer $form, ClientSalesDrop $record) => (!$record->clientSalesDropDetail) ? $form->fill() : $form->model($record->clientSalesDropDetail)->fill($record->clientSalesDropDetail->toArray()))
                    ->action(function (ClientSalesDrop $record, ClientSalesDropDetail $clientSalesDropDetail, array $data) {

                        // dd($record->clientSalesDropDetail->id);
                        if (!$record->clientSalesDropDetail) {
                            $clientSalesDropDetail->create($data);

                            $clientSalesDropDetail->productVariations()->attach($data['productVariations']);
                        } else {
                            $record->clientSalesDropDetail->update($data);

                            $clientSalesDropDetail = ClientSalesDropDetail::find($record->clientSalesDropDetail->id);

                            $clientSalesDropDetail->productVariations()->attach($data['productVariations']);
                        }
                    })
                    ->form([
                        Fieldset::make('Drop details')
                            ->schema([
                                TextInput::make('client_sales_drop_id')
                                    ->disabled()
                                    ->default(fn (ClientSalesDrop $record) => $record->id),
                                Select::make('drop_reason_id')
                                    ->options(DropReason::pluck('name', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->label('Drop reason'),
                                Select::make('competitor_id')
                                    ->options(Competitor::pluck('name', 'id'))
                                    ->label('Losted to'),
                                Select::make('family_id')
                                    ->options(Family::pluck('name', 'id'))
                                    ->label('Product family on drop'),
                                MultiSelect::make('productVariations')
                                    ->options(ProductVariation::where('status', 'active')->pluck('name', 'id'))
                                    /* ->saveRelationshipsUsing(function (array $state, ClientSalesDropDetail $record) {

                                        if ($record->productVariations()->exists()) {
                                            $record->productVariations()->detach($state);
                                        }
                                        $record->productVariations()->attach($state);
                                    }) */

                            ]),
                    ]),

                Tables\Actions\Action::make('view')
                    ->action('')
                    ->modalContent(view('livewire.sales-drop-detail-comments')),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageClientSalesDrops::route('/'),
        ];
    }
}
