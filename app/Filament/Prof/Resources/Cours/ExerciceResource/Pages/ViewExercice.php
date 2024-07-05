<?php

namespace App\Filament\Prof\Resources\Cours\ExerciceResource\Pages;

use App\Filament\Prof\Resources\Cours\ExerciceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExercice extends ViewRecord
{
    protected static string $resource = ExerciceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
