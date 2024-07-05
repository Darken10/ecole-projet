<?php

namespace App\Filament\Prof\Resources\Cours\QuestionResource\Pages;

use App\Filament\Prof\Resources\Cours\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
