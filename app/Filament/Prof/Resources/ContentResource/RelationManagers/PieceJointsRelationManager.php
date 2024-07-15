<?php

namespace App\Filament\Prof\Resources\ContentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\PieceJoint;
use App\Models\Cours\TypePieceJoint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PieceJointsRelationManager extends RelationManager
{
    protected static string $relationship = 'piece_joints';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Le Titre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type_piece_joint_id')
                    ->options(TypePieceJoint::all()->pluck('name','id'))
                    ->native(False)
                    ->label('Type de fichier')
                    ->required(),
                Forms\Components\FileUpload::make('url')
                    ->required()
                    ->label('La Piece a Joindre')
                    ->columnSpanFull(),
            ]);
    }



    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    function isReadOnly(): bool
    {
        return false;
    }
}
