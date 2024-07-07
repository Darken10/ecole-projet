<?php

namespace App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource\Pages;

use App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserQuestion extends CreateRecord
{
    protected static string $resource = UserQuestionResource::class;
}
