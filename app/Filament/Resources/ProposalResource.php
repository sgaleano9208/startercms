<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Client;
use App\Models\Proposal;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ProductVariation;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\ProposalResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProposalResource\RelationManagers;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class ProposalResource extends Resource

{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    TextInput::make('number')
                    ->label('Nº')
                    ->required()
                    ->disabled()
                    ->default(function(){
                        $date = date_format(now(), 'dm');
                        return 'PR-'.$date.'-'.random_int(001,999);
                    }),
                    TextInput::make('name'),
                    DatePicker::make('date')
                    ->required()
                    ->default(now()),
                    Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                    DatePicker::make('end_date'),
                    Select::make('type_of_payment_id')
                    ->relationship('TypeOfPayment', 'name'),
                    Radio::make('status')
                    ->options([
                        'sent' => 'Sent',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'negotiation' => 'Negotionation',
                    ])
                    ->required()
                    ->default('sent'),
                    Textarea::make('observation')
                    ->columnSpan('full')
                ])->columns(2),
                Card::make()
                ->schema([

                    /* TableRepeater::make('proposalItems')
                    ->relationship('proposalItems')
                    ->schema([
                        Select::make('product_variation_id')
                        ->options(ProductVariation::all()->where('status', 'active')->pluck('name', 'id'))
                        ->searchable()
                        ->label('Product')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function(callable $set, $state) {
                            $product = ProductVariation::find($state);
                            if($product){
                            $set('name', $product->name);
                            $set('price', $product->price);
                            }
                        }),
                        TextInput::make('name'),
                        TextInput::make('price')
                        ->numeric()
                        ->lazy()
                        ->afterStateUpdated(function(callable $set, callable $get, $state){
                            $netPrice = ($state * $get('quantity'));
                            if($get('discount')){
                            $netPrice = $state - ($state * ($get('discount') / 100));
                            }
                            $set('net_price', number_format($netPrice, 2, '.'));
                        }),
                        TextInput::make('discount')
                        ->numeric()
                        ->default(function(callable $get){
                            $discount = Client::find($get('../../client_id'));
                            return $discount->discount;
                        }),
                        TextInput::make('discount1')
                        ->numeric(),
                        TextInput::make('quantity')
                        ->numeric()
                        ->minValue(1)
                        ->default(1),
                        TextInput::make('net_price')
                        ->numeric(),
                    ])
                    ->collapsible()
                    ->defaultItems(3), */


                    Repeater::make('proposalItems')
                    ->relationship()
                    ->label('Proposal details')
                    ->schema([
                        Select::make('product_variation_id')
                        ->options(ProductVariation::all()->where('status', 'active')->pluck('name', 'id'))
                        ->searchable()
                        ->label('Product')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function(callable $set, $state) {
                            $product = ProductVariation::find($state);
                            if($product){
                            $set('name', $product->name);
                            $set('price', $product->price);
                            }
                        }),
                        TextInput::make('name'),
                        TextInput::make('price')
                        ->numeric()
                        ->lazy()
                        ->afterStateUpdated(function(callable $set, callable $get, $state){
                            $netPrice = ($state * $get('quantity'));
                            if($get('discount')){
                            $netPrice = $state - ($state * ($get('discount') / 100));
                            }
                            $set('net_price', number_format($netPrice, 2, '.'));
                        }),
                        TextInput::make('discount')
                        ->numeric()
                        ->default(function(callable $get){
                            $discount = Client::find($get('../../client_id'));
                            return $discount->discount;
                        }),
                        TextInput::make('discount1')
                        ->numeric(),
                        TextInput::make('quantity')
                        ->numeric()
                        ->minValue(1)
                        ->default(1),
                        TextInput::make('net_price')
                        ->numeric(),
                        ])
                    ->columns(7)
                    ->createItemButtonLabel('Add new product')
                    ->defaultItems(0)
                    ->cloneable()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('client.name')
                ->searchable()
                ->sortable(),
                TextColumn::make('date')
                ->date('d/m/Y'),
                BadgeColumn::make('status')
                ->enum([
                    'sent' => 'Sent',
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                    'negotiation' => 'Negotionation',
                ])
                ->colors([
                    'primary',
                    'warning' => 'negotiation',
                    'success' => 'accepted',
                    'danger' => 'rejected',
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                ->action('donwloadPDF')
                ->iconButton()
                ->icon('heroicon-o-download')
                ->color('primary')
                ->tooltip('Download pdf'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            ProposalResource\Widgets\ProposalOverview::class,
        ];
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
            'index' => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            'edit' => Pages\EditProposal::route('/{record}/edit'),
        ];
    }
}
