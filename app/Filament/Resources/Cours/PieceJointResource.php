<?php

namespace App\Filament\Resources\Cours;

use App\Filament\Resources\Cours\PieceJointResource\Pages;
use App\Filament\Resources\Cours\PieceJointResource\RelationManagers;
use App\Models\Cours\PieceJoint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PieceJointResource extends Resource
{
    protected static ?string $model = PieceJoint::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                /*Forms\Components\TextInput::make('url')
                    ->required(),*/
                Forms\Components\FileUpload::make('url')
                    ->required(),
                Forms\Components\Select::make('type_piece_joint_id')
                    ->relationship('type_piece_joint', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_piece_joint.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPieceJoints::route('/'),
            'create' => Pages\CreatePieceJoint::route('/create'),
            'edit' => Pages\EditPieceJoint::route('/{record}/edit'),
        ];
    }
}
