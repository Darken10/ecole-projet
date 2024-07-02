<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ChapitreResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ChapitreResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChapitre extends ViewRecord
{
    protected static string $resource = ChapitreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
