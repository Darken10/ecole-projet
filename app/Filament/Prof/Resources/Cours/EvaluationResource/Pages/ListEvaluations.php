<?php

namespace App\Filament\Prof\Resources\Cours\EvaluationResource\Pages;

use App\Filament\Prof\Resources\Cours\EvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluations extends ListRecords
{
    protected static string $resource = EvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
