<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms;
use App\Models\Cita;

class CitasRelationManager extends RelationManager
{
    protected static string $relationship = 'citas';
    protected static ?string $title = 'Citas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'nombre')
                    ->required()
                    ->label('Doctor'),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
                Forms\Components\TimePicker::make('hora')
                    ->required(),
                Forms\Components\TextInput::make('observaciones')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('doctor.nombre')
                    ->label('Doctor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora')
                    ->sortable(),
                Tables\Columns\TextColumn::make('observaciones')
                    ->wrap(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
