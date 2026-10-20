<?php

declare(strict_types=1);

namespace App\Filament\Resources\Concerts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class ConcertForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Extrait')
                    ->helperText('Court résumé affiché sur la carte du concert.')
                    ->rows(3)
                    ->maxLength(500)
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['h2', 'h3'],
                        ['bulletList', 'orderedList'],
                        ['undo', 'redo'],
                    ])
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('concerts')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
