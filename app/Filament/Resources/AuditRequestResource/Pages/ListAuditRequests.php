<?php

namespace App\Filament\Resources\AuditRequestResource\Pages;

use App\Filament\Resources\AuditRequestResource;
use Filament\Resources\Pages\ListRecords;

class ListAuditRequests extends ListRecords
{
    protected static string $resource = AuditRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
