<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContents extends ListRecords
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
