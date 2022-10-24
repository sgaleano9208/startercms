<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Family;
use App\Models\Product;
use App\Models\SubFamily;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Layout;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use League\CommonMark\Input\MarkdownInput;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                FileUpload::make('photo')->image()
                                    ->imagePreviewHeight('100')
                                    ->loadingIndicatorPosition('left')
                                    ->panelAspectRatio('1:1')
                                    ->panelLayout('integrated')
                                    ->removeUploadedFileButtonPosition('left')
                                    ->uploadButtonPosition('right')
                                    ->label('Main image')
                                    ->uploadProgressIndicatorPosition('right'),
                                FileUpload::make('certificate')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->label('Certificate')
                                    ->enableDownload(),
                                FileUpload::make('technical_sheet')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->label('Technical Sheet')
                                    ->enableDownload(),
                                Radio::make('type')
                                    ->inline()
                                    ->options([
                                        'own' => 'Own',
                                        'distributed' => 'Distributed',
                                    ])
                                    ->default('active'),
                            ])
                            ->columnSpan(1),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->columnSpan('full'),
                                TextInput::make('ref')
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->preload()
                                    ->searchable(),
                                MarkdownEditor::make('description')
                                    ->toolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'italic',
                                        'orderedList',
                                    ])
                                    ->columnSpan('full'),
                                Select::make('family_id')
                                    ->options(Family::all()->pluck('name', 'id'))
                                    ->label('Family')
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('sub_family_id', null)),
                                Select::make('sub_family_id')
                                    ->options(function (callable $get) {
                                        $family = Family::find($get('family_id'));
                                        if (!$family) {
                                            return SubFamily::all()->pluck('name', 'id');
                                        }
                                        return $family->subFamilies()->pluck('name', 'id');
                                    })
                                    ->label('Sub Family')
                                    ->searchable(),
                            ])->columnSpan(3)
                    ])->columns(4)
            ]);
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo'),
                TextColumn::make('ref')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('brand.name'),
            ])
            ->filters([
                SelectFilter::make('family_id')
                    ->relationship('family', 'name')
                    ->label('Family')
                    ->multiple(),
                SelectFilter::make('sub_family_id')
                    ->relationship('subFamily', 'name')
                    ->label('Sub Family')
                    ->multiple(),
                SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Brand')
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductResource\RelationManagers\ProductVariationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
