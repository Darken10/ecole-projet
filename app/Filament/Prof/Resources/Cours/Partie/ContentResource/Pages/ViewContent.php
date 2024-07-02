<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContent extends ViewRecord
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
