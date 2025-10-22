<?php

namespace App\Filament\Resources\SocialSettings;

use App\Filament\Resources\SocialSettings\Pages\CreateSocialSetting;
use App\Filament\Resources\SocialSettings\Pages\EditSocialSetting;
use App\Filament\Resources\SocialSettings\Pages\ListSocialSettings;
use App\Filament\Resources\SocialSettings\Schemas\SocialSettingForm;
use App\Filament\Resources\SocialSettings\Tables\SocialSettingsTable;
use App\Models\SocialSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SocialSettingResource extends Resource
{
    protected static ?string $model = SocialSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SocialSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSocialSettings::route('/'),
            'create' => CreateSocialSetting::route('/create'),
            'edit' => EditSocialSetting::route('/{record}/edit'),
        ];
    }
}
