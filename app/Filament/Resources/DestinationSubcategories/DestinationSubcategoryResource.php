<?php

namespace App\Filament\Resources\DestinationSubcategories;

use App\Filament\Resources\DestinationSubcategories\Pages\CreateDestinationSubcategory;
use App\Filament\Resources\DestinationSubcategories\Pages\EditDestinationSubcategory;
use App\Filament\Resources\DestinationSubcategories\Pages\ListDestinationSubcategories;
use App\Filament\Resources\DestinationSubcategories\Schemas\DestinationSubcategoryForm;
use App\Filament\Resources\DestinationSubcategories\Tables\DestinationSubcategoriesTable;
use App\Models\DestinationSubcategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DestinationSubcategoryResource extends Resource
{
    protected static ?string $model = DestinationSubcategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DestinationSubcategory';

    public static function form(Schema $schema): Schema
    {
        return DestinationSubcategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DestinationSubcategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDestinationSubcategories::route('/'),
            'create' => CreateDestinationSubcategory::route('/create'),
            'edit' => EditDestinationSubcategory::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
