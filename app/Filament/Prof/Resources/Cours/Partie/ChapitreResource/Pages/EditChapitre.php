<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ChapitreResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ChapitreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChapitre extends EditRecord
{
    protected static string $resource = ChapitreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
