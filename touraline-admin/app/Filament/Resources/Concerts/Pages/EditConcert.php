<?php

declare(strict_types=1);

namespace App\Filament\Resources\Concerts\Pages;

use App\Filament\Resources\Concerts\ConcertResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditConcert extends EditRecord
{
    protected static string $resource = ConcertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
