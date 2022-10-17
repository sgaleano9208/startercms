<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\State;
use App\Models\Client;
use Livewire\Livewire;
use App\Models\Country;
use App\Models\Typology;
use App\Models\Cooperative;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Layout;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Models\ClientCooperativeHistory;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientResource\RelationManagers;

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
                        MultiSelect::make('cooperatives')
                            ->relationship('cooperatives', 'name')
                            ->columnSpan('full')
                            ->preload()
                            ->reactive()
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
                                        ->timezone('Europe/Madrid'),
                                    DatePicker::make('end_date')
                                        ->displayFormat('d/m/Y')
                                        ->timezone('Europe/Madrid')
                                        ->minDate(fn ($get) => $get('start_date')),
                                    Textarea::make('observation')
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
                        Select::make('type')
                            ->options([
                                'member' => 'Member',
                                'directional' => 'Directional',
                                'lead' => 'Lead'
                            ])
                            ->default('member')
                            ->required(),
                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                        Select::make('typology_id')
                            ->options(Typology::all()->pluck('name', 'id'))
                            ->label('Typology')
                            ->searchable(),
                        Select::make('country_id')
                            ->options(Country::all()->pluck('name', 'id'))
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
                                    return State::all()->pluck('name', 'id');
                                }
                                return $country->states()->pluck('name', 'id');
                            })
                            ->placeholder('Please select a country')
                            ->searchable()
                            ->label('State'),
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
                    ->sortable()
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
                    ->colors(['primary'])
                    ->icon('heroicon-s-user')
                    ->iconPosition('after'),
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
                    ->iconPosition('after')

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
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->iconButton(),
                Tables\Actions\EditAction::make()
                ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    public static function getWidgets(): array
    {
        return [
            ClientResource\Widgets\ClientOverview::class,
        ];
    }



    public static function getRelations(): array
    {
        return [
            RelationManagers\ClientCooperativeHistoriesRelationManager::class,
            RelationManagers\ContactRelationManager::class,
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
