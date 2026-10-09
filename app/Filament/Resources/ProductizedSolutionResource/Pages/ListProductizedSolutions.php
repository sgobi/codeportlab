<?php

namespace App\Filament\Resources\ProductizedSolutionResource\Pages;

use App\Filament\Resources\ProductizedSolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductizedSolutions extends ListRecords
{
    protected static string $resource = ProductizedSolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
