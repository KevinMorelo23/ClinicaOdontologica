<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\RelationManagers\CitasRelationManager;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('telefono')->required(),
            ]);
    }



    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista', 'doctor']);
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista', 'doctor']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(['admin']);
    }




    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('telefono'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\ClienteResource\RelationManagers\CitasRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
