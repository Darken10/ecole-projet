<?php

namespace App\Filament\Prof\Resources\Cours\Partie\LessonResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
