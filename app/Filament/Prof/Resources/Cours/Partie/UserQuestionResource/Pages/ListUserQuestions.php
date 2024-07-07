<?php

namespace App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserQuestions extends ListRecords
{
    protected static string $resource = UserQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
