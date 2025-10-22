<?php

namespace App\Filament\Resources\SocialSettings\Pages;

use App\Filament\Resources\SocialSettings\SocialSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSocialSettings extends ListRecords
{
    protected static string $resource = SocialSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
