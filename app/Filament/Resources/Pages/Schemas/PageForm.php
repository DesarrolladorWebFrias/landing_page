<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str; // ✅ AGREGAR ESTE IMPORT

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->required()
                    ->maxLength(200)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $operation) {
                        // ✅ Quitar el tipo Set del parámetro - Filament lo inyecta automáticamente
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->disabled(fn ($operation) => $operation === 'create')
                    ->dehydrated()
                    ->helperText('Este campo se genera automáticamente desde el título'),

                Textarea::make('meta_description')
                    ->columnSpanFull(),

                TextInput::make('meta_keywords'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
