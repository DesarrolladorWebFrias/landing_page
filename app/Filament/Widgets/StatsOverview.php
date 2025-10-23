<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Testimonios', Testimonial::count())
                ->description('En el sistema')
                ->color('success'),
            
            Stat::make('Testimonios Publicados', Testimonial::where('is_published', true)->count())
                ->description('Visibles al público')
                ->color('success'),
        ];
    }
}