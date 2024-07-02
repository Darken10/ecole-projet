<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\ContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContent extends EditRecord
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
