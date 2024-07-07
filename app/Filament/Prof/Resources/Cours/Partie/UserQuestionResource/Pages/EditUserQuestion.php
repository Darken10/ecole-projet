<?php

namespace App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserQuestion extends EditRecord
{
    protected static string $resource = UserQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
