<?php

namespace App\Filament\Widgets;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class EstadisticasDashboard extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Clientes Actuales', Cliente::count()),
            Stat::make('Doctores Actuales', Doctor::count()),
            Stat::make('Citas Pendientes', Cita::where('fecha_hora', '>', now())->count()),
            Stat::make('Citas del Día', Cita::where('fecha', now()->toDateString())->count()),

        ];
    }
    protected function getColumns(): int
    {
        return 4; // Hace que las tarjetas ocupen una fila de 4 columnas
    }
}
