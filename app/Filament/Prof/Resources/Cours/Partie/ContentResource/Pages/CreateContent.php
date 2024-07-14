<?php

namespace App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Prof\Resources\Cours\Partie\ContentResource;

class CreateContent extends CreateRecord
{
    protected static string $resource = ContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
         $data['user_id']=auth()->user()->id;
         return $data;

    }
}
