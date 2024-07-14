<?php

namespace App\Filament\Prof\Resources\Cours\Partie\LessonResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Prof\Resources\Cours\Partie\LessonResource;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
         $data['user_id']=auth()->user()->id;
         return $data;

    }
    
}
