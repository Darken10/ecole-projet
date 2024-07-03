<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ObjectifResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ObjectifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectifs extends ListRecords
{
    protected static string $resource = ObjectifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
