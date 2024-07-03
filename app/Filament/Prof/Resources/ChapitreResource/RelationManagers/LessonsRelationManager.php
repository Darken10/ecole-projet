<?php

namespace App\Filament\Prof\Resources\ChapitreResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Statut;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Chapitre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make("")
                    ->schema([
                        Forms\Components\TextInput::make('lesson_numero')
                            ->required()
                            ->label('numero')
                            ->numeric()
                            ->default(1)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(5),

                        Forms\Components\Select::make('user_id')
                            ->options([auth()->user()->id => auth()->user()->name])
                            ->default(auth()->user()->id)
                            ->native(false)
                            ->required()
                            ->columnSpan(3),
                        Forms\Components\Select::make('statut_id')
                            ->relationship('statut', 'name')
                            ->label("Le Statut")
                            ->required()
                            ->native(False)
                            ->columnSpan(3),
                        Forms\Components\FileUpload::make('image_uri')
                            ->label("Image")
                            ->image()
                            ->columnSpan(6),
                    ])->columns(6),





            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('chapitre.name'),
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
        return False;
    }
}
