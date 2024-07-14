<?php

namespace App\Filament\Resources\Cours\NiveauResource\Pages;

use App\Filament\Resources\Cours\NiveauResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNiveau extends EditRecord
{
    protected static string $resource = NiveauResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
