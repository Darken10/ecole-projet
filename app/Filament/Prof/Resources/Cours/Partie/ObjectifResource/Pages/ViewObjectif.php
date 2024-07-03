<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ObjectifResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ObjectifResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewObjectif extends ViewRecord
{
    protected static string $resource = ObjectifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
