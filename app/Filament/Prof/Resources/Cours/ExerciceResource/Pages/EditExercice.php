<?php

namespace App\Filament\Prof\Resources\Cours\ExerciceResource\Pages;

use App\Filament\Prof\Resources\Cours\ExerciceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExercice extends EditRecord
{
    protected static string $resource = ExerciceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
