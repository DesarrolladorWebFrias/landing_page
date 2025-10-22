<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Testimonios', Testimonial::count())
                ->description('Testimonios en el sistema')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->color('success'),
            
            Stat::make('Testimonios Publicados', Testimonial::where('is_published', true)->count())
                ->description('Visibles al público')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success'),
            
            Stat::make('Testimonios Destacados', Testimonial::where('is_featured', true)->count())
                ->description('Marcados como destacados')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning'),
            
            Stat::make('Mensajes de Contacto', ContactMessage::count())
                ->description('Solicitudes recibidas')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('info'),
            
            Stat::make('Mensajes Nuevos', ContactMessage::where('status', 'new')->count())
                ->description('Por atender')
                ->descriptionIcon('heroicon-o-bell-alert')
                ->color('danger'),
        ];
    }
}