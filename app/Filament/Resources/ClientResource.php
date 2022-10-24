<?php

namespace App\Filament\Resources;


use Filament\Tables;

use App\Models\Client;
use App\Models\Country;
use App\Models\Cooperative;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Models\ClientCooperativeHistory;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\State;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    public $record;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Fieldset::make('Personal Details')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->columnSpan('full'),
                                TextInput::make('phone')
                                    ->unique(ignoreRecord: true)
                                    ->tel(),
                                TextInput::make('email')
                                    ->unique(ignoreRecord: true)
                                    ->email(),
                                TextInput::make('vat')
                                    ->unique(ignoreRecord: true)
                                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('a-00000000')),
                                TextInput::make('no_nav')
                                    ->unique(ignoreRecord: true)
                                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('000000a')),
                            ]),
                        Fieldset::make('Commercial information')
                            ->schema([
                                Select::make('cooperatives')
                                    ->relationship('cooperatives', 'name')
                                    ->columnSpan('full')
                                    ->multiple()
                                    ->preload()
                                    ->reactive()
                                    ->maxItems(2)
                                    ->afterStateUpdated(fn ($livewire) => $livewire->visible = 1)
                                    ->createOptionForm(function (callable $get) {
                                        $cooperatives = $get('cooperatives');
                                        $esquema = [
                                            Select::make('cooperative_id')
                                                ->options(fn () => Cooperative::find($cooperatives)->pluck('name', 'id'))
                                                ->label('Cooperatives')
                                                ->required(),
                                            DatePicker::make('start_date')
                                                ->displayFormat('d/m/Y')
                                                ->closeOnDateSelection(),
                                            DatePicker::make('end_date')
                                                ->displayFormat('d/m/Y')
                                                ->minDate(fn ($get) => $get('start_date'))
                                                ->closeOnDateSelection(),
                                            Textarea::make('observation')
                                                ->maxLength(255),
                                        ];
                                        return $esquema;
                                    })
                                    ->createOptionAction(function (Action $action) {
                                        return $action
                                            ->modalHeading('Add a cooperative change')
                                            ->modalSubheading('Register the current change in cooperatives for this client')
                                            ->color('danger')
                                            ->tooltip('Add new register')
                                            ->modalActions([
                                                Action::makeModalAction('submit')
                                                    ->label('Submit')
                                                    ->submit()
                                                    ->color('success')
                                                    ->icon('heroicon-s-save'),
                                                Action::makeModalAction('cancel')
                                                    ->label('Cancel')
                                                    ->cancel()
                                                    ->color('secondary')
                                                    ->icon('heroicon-o-arrow-left'),
                                            ])
                                            ->visible(fn ($livewire): bool => $livewire->visible != null);
                                    })
                                    ->createOptionUsing(static function (ClientCooperativeHistory $clientCoopHistory, Client $record, callable $set, callable $get, array $data) {
                                        $data['client_id'] = $record->id;
                                        $clientCoopHistory->create($data);
                                    }),
                                Select::make('sales_person_id')
                                ->relationship('salesPerson', 'name')
                                ->searchable()
                                ->preload(),
                                Select::make('typology_id')
                                    ->relationship('typology', 'name')
                                    ->label('Typology')
                                    ->searchable(),
                            ]),
                        Fieldset::make('Other information')
                            ->schema([
                                Select::make('type')
                                    ->options([
                                        'member' => 'Member',
                                        'directional' => 'Directional',
                                        'lead' => 'Lead'
                                    ])
                                    ->default('member')
                                    ->required()
                                    ->disablePlaceholderSelection(),
                                Select::make('status')
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                    ])
                                    ->default('active')
                                    ->required()
                                    ->disablePlaceholderSelection(),
                                Select::make('country_id')
                                    ->relationship('country', 'name')
                                    ->label('Country')
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(function (callable $set) {
                                        $set('state_id', null);
                                    }),
                                Select::make('state_id')
                                    ->options(function (callable $get) {
                                        $country = Country::find($get('country_id'));
                                        if (!$country) {
                                            // return State::all()->pluck('name', 'id');
                                            return ['Please select a country'];
                                        }
                                        return $country->states()->pluck('name', 'id');
                                    })
                                    ->placeholder('Please select a country')
                                    ->searchable()
                                    ->label('State'),
                            ]),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(['name', 'email']),
                TextColumn::make('no_nav')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cooperatives.name')
                    ->wrap(),
                TextColumn::make('state.name')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('type')
                    ->enum([
                        'member' => 'Member',
                        'directional' => 'Directional',
                        'lead' => 'Lead'
                    ])
                    ->color('primary')
                    ->icon('heroicon-s-user'),
                BadgeColumn::make('status')
                    ->enum([
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ])
                    ->colors([
                        'success',
                        'danger' => 'inactive'
                    ])
                    ->icons([
                        'heroicon-s-x-circle',
                        'heroicon-s-check-circle' => 'active'
                    ])

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                SelectFilter::make('type')
                    ->options([
                        'member' => 'Member',
                        'directional' => 'Directional',
                        'lead' => 'Lead',
                    ])
                    ->multiple(),
                SelectFilter::make('cooperatives')
                ->relationship('cooperatives', 'name')
                ->multiple()
                ->searchable(),
                SelectFilter::make('sales_person_id')
                ->relationship('salesPerson', 'name')
                ->multiple()
                ->searchable(),
                SelectFilter::make('commercial')
                ->relationship('commercial', 'name')
                ->multiple()
                ->searchable(),


            /* Select::make('country_id')
                ->relationship('country', 'name')
                ->label('Country')
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function (callable $set) {
                    $set('state_id', null);
                }),
            Select::make('state_id')
                ->options(function (callable $get) {
                    $country = Country::find($get('country_id'));
                    if (!$country) {
                        // return State::all()->pluck('name', 'id');
                        return ['Please select a country'];
                    }
                    return $country->states()->pluck('name', 'id');
                })
                ->placeholder('Please select a country')
                ->searchable()
                ->label('State'), */

                Filter::make('country_state')
                ->form([
                    Select::make('country_id')
                    ->options(Country::has('clients')->pluck('name', 'id'))
                    ->reactive()
                    ->callAfterStateUpdated(fn(callable $set) => $set('state_id', null)),
                    Select::make('state_id')
                    ->options(function(callable $get){
                        $country = Country::find($get('country_id'));
                        if(!$country){
                            return ['First select a country'];
                        }
                        return $country->states()->pluck('name', 'id');
                    })
                ])
                ->query(function(Builder $query, array $data): Builder {
                    return $query
                    ->when($data['country_id'], 
                    fn(Builder $query): Builder => $query->where('country_id', $data['country_id']))
                    ->when($data['state_id'], 
                    fn(Builder $query): Builder => $query->where('state_id', $data['state_id']))
                    ;
                }),

                SelectFilter::make('typology_id')
                ->relationship('typology', 'name')
                ->multiple()
                ->label('Typology')
                ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                Tables\Actions\BulkAction::make('client_update')
                ->action(function(Collection $records, array $data): void {
                    foreach($records as $record) {
                        $record->status = $data['status'];
                        $record->save();
                    }
                })
                ->form([
                    Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required()
                    ->disablePlaceholderSelection(),
                ])
                ->deselectRecordsAfterCompletion()
            ]);
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ClientCooperativeHistoriesRelationManager::class,
            RelationManagers\ContactRelationManager::class,
            RelationManagers\ProposalsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
            'stats' => Pages\StatsClient::route('/{record}/stats'),
        ];
    }
}
