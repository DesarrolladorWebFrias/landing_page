<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title'),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author_name'),
                TextInput::make('author_position'),
                TextInput::make('organization'),
                TextInput::make('created_by')
                    ->numeric(),
                TextInput::make('updated_by')
                    ->numeric(),
                Toggle::make('is_published')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                DateTimePicker::make('published_at'),
                TextInput::make('view_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
