<?php

namespace App\Filament\Widgets;

use App\Models\Cita;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class CitasDelDiaTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = '📅 Citas Programadas para Hoy';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table

            ->query(
                Cita::where('fecha', now()->toDateString()) // Filtra por citas del día
                    ->orderBy('hora') // Ordena por la hora más cercana
            )
            ->columns([
                Tables\Columns\TextColumn::make('hora')
                    ->label('Hora'),
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('doctor.nombre')
                    ->label('Doctor'),
                Tables\Columns\TextColumn::make('observaciones')
                    ->label('Observaciones')
                    ->wrap()
                    ->limit(15),
            ]);
    }
}
