<?php

namespace App\Filament\Resources\SiteProfileResource\Pages;

use App\Filament\Resources\SiteProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteProfile extends EditRecord
{
    protected static string $resource = SiteProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
