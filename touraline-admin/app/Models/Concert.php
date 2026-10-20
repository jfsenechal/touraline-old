<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ConcertFactory;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

final class Concert extends Model
{
    /** @use HasFactory<ConcertFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        /* New concerts go to the end of the list unless a position is given. */
        self::creating(function (Concert $concert): void {
            if (blank($concert->position)) {
                $concert->position = (int) self::query()->max('position') + 1;
            }
        });

        /* Remove the previous image from disk when it is replaced or the concert is deleted. */
        self::updated(function (Concert $concert): void {
            $previous = $concert->getOriginal('image');

            if ($concert->wasChanged('image') && filled($previous)) {
                Storage::disk('public')->delete($previous);
            }
        });

        self::deleted(function (Concert $concert): void {
            if (filled($concert->image)) {
                Storage::disk('public')->delete($concert->image);
            }
        });
    }

    /**
     * Order concerts as arranged in the admin.
     *
     * @param  Builder<Concert>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('position')->orderBy('id');
    }

    /**
     * Public URL of the image, or null when none was uploaded.
     *
     * @return Attribute<?string, never>
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => filled($this->image)
            ? Storage::disk('public')->url($this->image)
            : null);
    }

    /**
     * Sanitized HTML of the rich-text description, safe to echo unescaped.
     *
     * @return Attribute<string, never>
     */
    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn (): string => filled($this->description)
            ? RichContentRenderer::make($this->description)->toHtml()
            : '');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }
}
