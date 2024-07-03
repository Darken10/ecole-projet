<?php

namespace App\Filament\Prof\Resources\Cours\Partie\PreRequieResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\PreRequieResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPreRequie extends ViewRecord
{
    protected static string $resource = PreRequieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
