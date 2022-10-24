<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use App\Models\Proposal;
use App\Models\ProposalItem;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProposalsRelationManager extends RelationManager
{
    protected static string $relationship = 'proposals';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('number')
                    ->label('Nº')
                    ->required()
                    ->disabled()
                    ->default(function(){
                        $date = date_format(now(), 'dm');
                        return 'PR-'.$date.'-'.random_int(001,999);
                    }),
                    Forms\Components\TextInput::make('name'),
                    Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now())
                    ->reactive()
                    ->closeOnDateSelection(),
                    Forms\Components\DatePicker::make('end_date')
                    ->closeOnDateSelection()
                    ->minDate(fn(callable $get) => $get('date')),
                    Forms\Components\Select::make('type_of_payment_id')
                    ->relationship('TypeOfPayment', 'name'),
                    Forms\Components\Radio::make('status')
                    ->options([
                        'sent' => 'Sent',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'negotiation' => 'Negotionation',
                    ])
                    ->required()
                    ->default('sent'),
                    Forms\Components\Textarea::make('observation')
                    ->columnSpan('full')
                ])->columns(2),
            ]);
    }

    public function donwloadPDF(Model $record)
    {
        $client = Client::find($record->client_id);
        $proposalItems = ProposalItem::where('proposal_id', $record->id)->get();

        $pdf = Pdf::loadView('app.proposal.pdf', ['data' => $record, 'proposalItems' => $proposalItems, 'client' => $client])->output();
        return response()->streamDownload(fn () => print($pdf), 'test.pdf');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('date')
                ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('proposal_items_sum_price')
                ->sum('proposalItems', 'price')
                ->money('eur')
                ->label('Total'),
                Tables\Columns\BadgeColumn::make('status')
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
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                ->action('donwloadPDF')
                ->iconButton()
                ->icon('heroicon-o-download')
                ->color('primary')
                ->tooltip('Download pdf'),

                Tables\Actions\EditAction::make()
                ->url(fn(Model $record) => route('filament.resources.proposals.edit', $record->id))
                ->visible(function($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);

                    
                }),
                // Tables\Actions\DeleteAction::make(),
            Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(function ($livewire) {
                    return !is_subclass_of($livewire->pageClass, ViewRecord::class);
                }),
            ]);
    }    
}
