<?php

namespace App\Filament\Resources\SiteProfileResource\Pages;

use App\Filament\Resources\SiteProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteProfile extends CreateRecord
{
    protected static string $resource = SiteProfileResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
