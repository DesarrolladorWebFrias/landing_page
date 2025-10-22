<?php

namespace App\Filament\Resources\SocialSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SocialSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('platform')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                Textarea::make('share_text')
                    ->columnSpanFull(),
                TextInput::make('whatsapp_number')
                    ->default('9141247950'),
                Textarea::make('whatsapp_message')
                    ->columnSpanFull(),
                TextInput::make('button_color')
                    ->default('#1877F2'),
            ]);
    }
}
