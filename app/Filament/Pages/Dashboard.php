<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // Elimina la propiedad $navigationIcon si existe
    // Filament ya proporciona un icono por defecto
    
    public function getHeading(): string
    {
        return 'Dashboard Principal';
    }

    public function getSubheading(): string
    {
        return 'Resumen del sistema de testimonios';
    }
}