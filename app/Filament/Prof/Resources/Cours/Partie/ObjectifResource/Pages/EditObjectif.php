<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ObjectifResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ObjectifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectif extends EditRecord
{
    protected static string $resource = ObjectifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
