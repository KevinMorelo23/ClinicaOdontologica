<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitaResource\Pages;
use App\Models\Cita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CitaResource extends Resource
{
    protected static ?string $model = Cita::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Citas';
    protected static ?string $pluralLabel = 'Citas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'nombre')
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'nombre')
                    ->required(),
                Forms\Components\DatePicker::make('fecha')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false),
                Forms\Components\TimePicker::make('hora')
                    ->required()

                    ->seconds(false),

                Forms\Components\Select::make('status')
                    ->options(fn() => [
                        'pendiente' => 'Pendiente',
                        'atendido' => 'Atendido',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('pendiente')
                    ->required(),

                Forms\Components\Textarea::make('observaciones')
                    ->nullable(),
            ]);
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista', 'doctor']);
    }

    public static function canView(?Model $record = null): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista', 'doctor']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista']);
    }

    public static function canEdit(?Model $record = null): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista', 'doctor']);
    }

    public static function canDelete(?Model $record = null): bool
    {
        return auth()->user()->hasRole(['admin', 'recepcionista']);
    }



    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor.nombre')
                    ->label('Doctor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date(),
                Tables\Columns\TextColumn::make('hora'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'pendiente' => 'warning',
                        'atendido' => 'success',
                        'cancelado' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('observaciones')
                    ->wrap(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCitas::route('/'),
            'create' => Pages\CreateCita::route('/create'),
            'edit' => Pages\EditCita::route('/{record}/edit'),
        ];
    }
}
