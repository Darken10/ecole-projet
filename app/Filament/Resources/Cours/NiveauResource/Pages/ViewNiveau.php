<?php

namespace App\Filament\Resources\Cours\NiveauResource\Pages;

use App\Filament\Resources\Cours\NiveauResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNiveau extends ViewRecord
{
    protected static string $resource = NiveauResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
