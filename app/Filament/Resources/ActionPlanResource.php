<?php

namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Tables;
use App\Models\ActionPlan;
use App\Models\Appointment;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActionPlanResource\Pages;
use App\Filament\Resources\ActionPlanResource\RelationManagers;

class ActionPlanResource extends Resource
{
    protected static ?string $model = ActionPlan::class;


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public $appointment_id;

    public function mount(): void
    {
        $this->appointment_id = session()->get('appointmentId');
        debug($this->appointment_id);
        // session()->forget('appointmentId');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('appointment_id')
                    ->relationship('appointment', 'id')
                    ->default(fn($livewire) => $livewire->appointment_id)
                    ->hidden(function($livewire): bool{
                        if(!$livewire->appointment_id){
                            return false;
                        }else{
                            return true;
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment_id')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListActionPlans::route('/'),
            'create' => Pages\CreateActionPlan::route('/create'),
            'edit' => Pages\EditActionPlan::route('/{record}/edit'),
        ];
    }
}
