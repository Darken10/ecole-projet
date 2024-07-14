<?php

namespace App\Filament\Prof\Resources\Cours\EvaluationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Prof\Resources\Cours\EvaluationResource;

class CreateEvaluation extends CreateRecord
{
    protected static string $resource = EvaluationResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
         $data['user_id']=auth()->user()->id;
         return $data;

    }
}
