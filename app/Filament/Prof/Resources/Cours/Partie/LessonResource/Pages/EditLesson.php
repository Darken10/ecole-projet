<?php

namespace App\Filament\Prof\Resources\Cours\Partie\LessonResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
