<?php

namespace App\Filament\Resources\SiteProfileResource\Pages;

use App\Filament\Resources\SiteProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteProfiles extends ListRecords
{
    protected static string $resource = SiteProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
