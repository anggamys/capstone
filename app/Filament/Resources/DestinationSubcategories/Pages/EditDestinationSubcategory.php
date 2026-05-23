<?php

namespace App\Filament\Resources\DestinationSubcategories\Pages;

use App\Filament\Resources\DestinationSubcategories\DestinationSubcategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDestinationSubcategory extends EditRecord
{
    protected static string $resource = DestinationSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
