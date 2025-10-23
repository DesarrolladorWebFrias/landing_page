<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentTestimonials extends BaseWidget
{
    protected static ?string $heading = 'Testimonios Recientes';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Testimonial::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('author_name')
                    ->label('Autor')
                    ->searchable(),

                Tables\Columns\TextColumn::make('body')
                    ->label('Contenido')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->trueColor('warning')
                    ->falseColor('gray'),
            ]);
            // ELIMINAMOS COMPLETAMENTE LA SECCIÓN ->actions()
    }
}