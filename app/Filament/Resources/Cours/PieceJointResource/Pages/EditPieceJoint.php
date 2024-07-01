<?php

namespace App\Filament\Resources\Cours\PieceJointResource\Pages;

use App\Filament\Resources\Cours\PieceJointResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPieceJoint extends EditRecord
{
    protected static string $resource = PieceJointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
