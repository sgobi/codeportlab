<?php

namespace App\Filament\Resources\TechUpdateResource\Pages;

use App\Filament\Resources\TechUpdateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechUpdates extends ListRecords
{
    protected static string $resource = TechUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
