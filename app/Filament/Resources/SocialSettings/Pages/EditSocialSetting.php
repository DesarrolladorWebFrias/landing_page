<?php

namespace App\Filament\Resources\SocialSettings\Pages;

use App\Filament\Resources\SocialSettings\SocialSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSocialSetting extends EditRecord
{
    protected static string $resource = SocialSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
