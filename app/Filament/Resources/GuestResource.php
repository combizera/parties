<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationLabel = 'Convidados';

    protected static ?string $modelLabel = 'Guest';

    protected static ?string $pluralModelLabel = 'Convidados';

    protected static ?string $slug = 'convidados';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Geral';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações Pessoais')
                    ->columns(2)
                    ->icon('heroicon-s-user')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->placeholder('Nome'),

                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Email'),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->placeholder('Telefone'),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->placeholder('Cidade'),
                    ])
                    ->collapsed(false),

                Section::make('Status e Pagamento')
                    ->icon('heroicon-s-banknotes')
                    ->columns(2)
                    ->schema([
                        Select::make('party_id')
                            ->label('Festa')
                            ->relationship('party', 'name')
                            ->required()
                            ->placeholder('Selecione a festa'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'confirmed' => 'Confirmado',
                                'cancelled' => 'Cancelado',
                            ])
                            ->required()
                            ->placeholder('Selecione o status'),

                        Checkbox::make('payed')
                            ->label('Pago')
                    ])
                    ->collapsed(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->placeholder('Nome'),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder('Email'),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->placeholder('Telefone'),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->badge()
                    ->placeholder('Cidade'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->placeholder('Status'),
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
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
