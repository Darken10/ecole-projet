<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Cours\Partie\Chapitre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\Partie\ChapitreResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\ChapitreResource\RelationManagers;
use App\Filament\Prof\Resources\ChapitreResource\RelationManagers\LessonsRelationManager;

class ChapitreResource extends Resource
{
    protected static ?string $model = Chapitre::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Gestion des Cours";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('niveau_id')
                    ->label('Le Niveau')
                    ->relationship('niveau', 'name')
                    ->searchable()
                    ->native(False)
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('matiere_id')
                    ->label('La Matière')
                    ->relationship('matiere', 'name')
                    ->searchable()
                    ->native(False)
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Titre du Chapitre')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matiere.name')
                    ->numeric()
                    ->label('Matière')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('niveau.name')
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
                Tables\Actions\ViewAction::make(),
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
            LessonsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChapitres::route('/'),
            'create' => Pages\CreateChapitre::route('/create'),
            'view' => Pages\ViewChapitre::route('/{record}'),
            'edit' => Pages\EditChapitre::route('/{record}/edit'),
        ];
    }
}
