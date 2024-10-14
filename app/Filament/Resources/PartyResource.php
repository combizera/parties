<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartyResource\Pages;
use App\Filament\Resources\PartyResource\RelationManagers;
use App\Models\Party;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartyResource extends Resource
{
    protected static ?string $model = Party::class;

    protected static ?string $navigationIcon = 'heroicon-s-cake';

    protected static ?string $navigationLabel = 'Rolê';

    protected static ?string $modelLabel = 'Party';

    protected static ?string $pluralModelLabel = 'Rolês';

    protected static ?string $slug = 'roles';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Geral';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Rolê')
                    ->icon('heroicon-s-cake')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome do Rolê')
                            ->required(),

                        TextInput::make('description')
                            ->label('Descrição')
                            ->required(),

                        TextInput::make('location')
                            ->label('Local')
                            ->required(),

                        TextInput::make('max_guests')
                            ->label('Máximo de Convidados')
                            ->numeric()
                            ->required(),
                    ])
                    ->collapsed(false),

                Section::make('Datas')
                    ->icon('heroicon-s-calendar')
                    ->schema([
                        DateTimePicker::make('started_at')
                            ->label('Data de Início')
                            ->required(),

                        DateTimePicker::make('ended_at')
                            ->label('Data de Término')
                            ->required(),
                    ])
                    ->collapsed(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome do Rolê')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('started_at')
                    ->label('Data')
                    ->sortable()
                    ->date(),

                TextColumn::make('location')
                    ->label('Local')
                    ->sortable(),

                TextColumn::make('guests_count')
                    ->label('Convidados')
                    ->badge()
                    ->counts('guests')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListParties::route('/'),
            'create' => Pages\CreateParty::route('/create'),
            'edit' => Pages\EditParty::route('/{record}/edit'),
        ];
    }
}
