<?php

namespace App\Filament\Resources\DestinationSubcategories\Pages;

use App\Filament\Resources\DestinationSubcategories\DestinationSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDestinationSubcategories extends ListRecords
{
    protected static string $resource = DestinationSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
