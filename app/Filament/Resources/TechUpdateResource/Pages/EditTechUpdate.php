<?php

namespace App\Filament\Resources\TechUpdateResource\Pages;

use App\Filament\Resources\TechUpdateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechUpdate extends EditRecord
{
    protected static string $resource = TechUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
