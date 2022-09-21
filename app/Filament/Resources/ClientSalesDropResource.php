<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Family;
use App\Models\Competitor;
use App\Models\DropReason;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ClientSalesDrop;
use App\Models\ProductVariation;
use Filament\Resources\Resource;
use App\Models\ClientSalesDropDetail;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientSalesDropResource\Pages;
use App\Filament\Resources\ClientSalesDropResource\RelationManagers;
use Closure;
use Filament\Tables\Columns\BooleanColumn;

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
                Tables\Actions\Action::make('create')
                    ->action(function (ClientSalesDropDetail $clientSalesDropDetail, array $data) {
                        $clientSalesDropDetail->create($data);

                        Notification::make()
                            ->title('Report created successfully')
                            ->success()
                            ->send();
                    })->hidden(fn (Model $record) => (!$record->_reported) ? false : true)
                    ->form([
                        Fieldset::make('Drop details')
                            ->schema([
                                Hidden::make('client_sales_drop_id')
                                    ->default(fn (Model $record): string => $record->id),
                                Select::make('drop_reason_id')
                                    ->options(DropReason::all()->pluck('name', 'id'))
                                    ->label('Drop reason'),
                                Select::make('competitor_id')
                                    ->options(Competitor::all()->pluck('name', 'id'))
                                    ->label('Losted to'),
                                Select::make('family_id')
                                    ->options(Family::all()->pluck('name', 'id'))
                                    ->label('Product family on drop'),
                                MultiSelect::make('productVariations')
                                    ->options(ProductVariation::where('status', 'active')->pluck('name', 'id')),
                            ]),
                        Repeater::make('comments')
                            ->schema([
                                DatePicker::make('commented_at')
                                    ->label('Comment date') 
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->disabled(),
                                MarkdownEditor::make('comment_body')
                                    ->label('Comment')
                            ])
                    ]),
                Tables\Actions\Action::make('edit')
                    ->mountUsing(function (Forms\ComponentContainer $form, ClientSalesDropDetail $clientSalesDropDetail, Model $record) {

                        $data = ClientSalesDropDetail::all()->where('client_sales_drop_id', $record->id);


                        $form->fill([
                        'drop_reason_id' => $data->pluck('drop_reason_id'),
                        'competitor_id' => $data->pluck('competitor_id'),
                        'family_id' => $data->pluck('family_id'),
                    ]);

                })
                    ->action(function (ClientSalesDropDetail $clientSalesDropDetail, array $data) {
                        $clientSalesDropDetail->create($data);

                        Notification::make()
                            ->title('Report created successfully')
                            ->success()
                            ->send();
                    })->hidden(fn (Model $record) => (!$record->_reported) ? true : false)
                    ->form([
                        Fieldset::make('Drop details')
                            ->schema([
                                Hidden::make('client_sales_drop_id')
                                    ->default(fn (Model $record): string => $record->id),
                                Select::make('drop_reason_id')
                                    ->options(DropReason::all()->pluck('name', 'id'))
                                    ->label('Drop reason'),
                                Select::make('competitor_id')
                                    ->options(Competitor::all()->pluck('name', 'id'))
                                    ->label('Losted to'),
                                Select::make('family_id')
                                    ->options(Family::all()->pluck('name', 'id'))
                                    ->label('Product family on drop'),
                                MultiSelect::make('productVariations')
                                    ->options(ProductVariation::where('status', 'active')->pluck('name', 'id')),
                            ]),
                        Repeater::make('comments')
                            ->schema([
                                DatePicker::make('commented_at')
                                    ->label('Comment date')
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->disabled(),
                                MarkdownEditor::make('comment_body')
                                    ->label('Comment')
                            ])
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
