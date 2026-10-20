<?php

declare(strict_types=1);

namespace App\Filament\Resources\Concerts;

use App\Filament\Resources\Concerts\Pages\CreateConcert;
use App\Filament\Resources\Concerts\Pages\EditConcert;
use App\Filament\Resources\Concerts\Pages\ListConcerts;
use App\Filament\Resources\Concerts\Schemas\ConcertForm;
use App\Filament\Resources\Concerts\Tables\ConcertsTable;
use App\Models\Concert;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class ConcertResource extends Resource
{
    protected static ?string $model = Concert::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMusicalNote;

    protected static ?string $modelLabel = 'concert';

    protected static ?string $pluralModelLabel = 'concerts';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'title',
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return ConcertForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConcertsTable::configure($table);
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
            'index' => ListConcerts::route('/'),
            'create' => CreateConcert::route('/create'),
            'edit' => EditConcert::route('/{record}/edit'),
        ];
    }
}
