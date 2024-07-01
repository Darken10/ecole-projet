<?php

namespace App\Filament\Resources\Cours\PieceJointResource\Pages;

use App\Filament\Resources\Cours\PieceJointResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPieceJoints extends ListRecords
{
    protected static string $resource = PieceJointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
