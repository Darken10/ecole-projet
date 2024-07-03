<?php

namespace App\Filament\Prof\Resources\Cours\Partie\PreRequieResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\PreRequieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreRequies extends ListRecords
{
    protected static string $resource = PreRequieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
