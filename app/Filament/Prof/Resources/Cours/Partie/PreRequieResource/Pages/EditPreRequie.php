<?php

namespace App\Filament\Prof\Resources\Cours\Partie\PreRequieResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\PreRequieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreRequie extends EditRecord
{
    protected static string $resource = PreRequieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
