<?php

declare(strict_types=1);

namespace App\Filament\Resources\Concerts\Pages;

use App\Filament\Resources\Concerts\ConcertResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateConcert extends CreateRecord
{
    protected static string $resource = ConcertResource::class;
}
