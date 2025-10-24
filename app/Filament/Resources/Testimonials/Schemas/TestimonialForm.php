<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor; // ✅ AGREGAR ESTE IMPORT
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title'),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull()
                     ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->fileAttachmentsDirectory('testimonials')
                    ->maxLength(5000),
                    
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
