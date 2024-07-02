<?php

namespace App\Filament\Prof\Resources\Cours\Partie\LessonResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
