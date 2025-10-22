<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class RecentTestimonials extends BaseWidget
{
    protected static ?string $heading = 'Testimonios Recientes';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Testimonial::query()
                    ->with(['creator'])
                    ->latest('published_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('title')
                            ->label('Título')
                            ->weight('bold')
                            ->searchable()
                            ->limit(50)
                            ->extraAttributes(['class' => 'text-primary-600']),
                        
                        Tables\Columns\TextColumn::make('body')
                            ->label('Contenido')
                            ->limit(100)
                            ->html()
                            ->formatStateUsing(fn ($state) => new HtmlString('<div class="text-sm text-gray-600 line-clamp-2">' . $state . '</div>')),
                        
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('author_name')
                                ->label('Autor')
                                ->size('sm')
                                ->color('gray')
                                ->icon('heroicon-o-user'),
                            
                            Tables\Columns\TextColumn::make('organization')
                                ->label('Organización')
                                ->size('sm')
                                ->color('gray')
                                ->icon('heroicon-o-building-office'),
                        ])->space(1),
                    ])->space(2),
                    
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\IconColumn::make('is_published')
                            ->label('Estado')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-badge')
                            ->falseIcon('heroicon-o-clock')
                            ->trueColor('success')
                            ->falseColor('warning')
                            ->size('lg'),
                        
                        Tables\Columns\IconColumn::make('is_featured')
                            ->label('Destacado')
                            ->boolean()
                            ->trueIcon('heroicon-o-star')
                            ->falseIcon('heroicon-o-star')
                            ->trueColor('warning')
                            ->falseColor('gray-300')
                            ->size('lg'),
                        
                        Tables\Columns\TextColumn::make('published_at')
                            ->label('Publicado')
                            ->since()
                            ->color('gray')
                            ->size('sm')
                            ->icon('heroicon-o-calendar'),
                    ])->space(2),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn (Testimonial $record): string => route('filament.admin.resources.testimonials.edit', $record)),
                
                Tables\Actions\Action::make('publish')
                    ->label('Publicar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Testimonial $record): void {
                        $record->update([
                            'is_published' => true,
                            'published_at' => now(),
                        ]);
                    })
                    ->requiresConfirmation()
                    ->visible(fn (Testimonial $record): bool => !$record->is_published),
                
                Tables\Actions\Action::make('feature')
                    ->label('Destacar')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->action(function (Testimonial $record): void {
                        $record->update([
                            'is_featured' => !$record->is_featured,
                        ]);
                    })
                    ->visible(fn (Testimonial $record): bool => $record->is_published),
            ])
            ->emptyStateHeading('No hay testimonios aún')
            ->emptyStateDescription('Crea el primer testimonio para comenzar.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Crear Testimonio')
                    ->url(route('filament.admin.resources.testimonials.create'))
                    ->icon('heroicon-o-plus')
                    ->button(),
            ]);
    }

    public static function canView(): bool
    {
        return auth()->user()->can('viewAny', Testimonial::class);
    }
}