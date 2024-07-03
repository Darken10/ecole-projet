<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Chapitre;
use Filament\Forms\Components\Wizard;
use Filament\Infolists\Components\Entry;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Prof\Resources\Cours\Partie\LessonResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\LessonResource\RelationManagers;
use App\Filament\Prof\Resources\LessonResource\RelationManagers\ContentsRelationManager;
use App\Filament\Prof\Resources\LessonResource\RelationManagers\ObjectifsRelationManager;
use App\Filament\Prof\Resources\LessonResource\RelationManagers\PreRequiesRelationManager;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Gestion des Cours';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Wizard\Step::make('Matière et Chapitre')
                        ->description('Les informations consernant la Matiere et le Chapitre')
                        ->schema([
                            Forms\Components\Select::make('matiere_id')
                                ->relationship('matiere', 'name')
                                ->live()
                                ->afterStateUpdated(fn (Set $set)=>$set('chapitre_id',null))
                                ->label("La Matière")
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->required(),
                            Forms\Components\Select::make('chapitre_id')
                                ->options(fn (Get $get): Collection => Chapitre::query()->where('matiere_id', $get('matiere_id'))->get()->pluck('title', 'id'))
                                ->label("Le Chapitre")
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->required(),
                        ])->columns(2),
                    Wizard\Step::make("Information de la Leçon")
                        ->description('Les informations consernant la leçon')
                        ->schema([
                            Forms\Components\TextInput::make('lesson_numero')
                                ->required()
                                ->label('numero')
                                ->numeric()
                                ->default(1)
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('title')
                                ->label("Le Titre de la Leçon")
                                ->required()
                                ->columnSpan(10),
                            Forms\Components\FileUpload::make('image_uri')
                                ->label("Image")
                                ->image()
                                ->columnSpan(6),
                            Forms\Components\Select::make('statut_id')
                                ->relationship('statut', 'name')
                                ->label("Le Statut")
                                ->required()
                                ->native(False)
                                ->columnSpan(6),

                        ])->columns(12),
                    Wizard\Step::make("Auteur")->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Le Professeur')
                            ->native(False)
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Publier le')
                            ->native(False)
                            ->required(),
                    ])->columns(2),
                ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lesson_numero')
                    ->label('Leçon')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_uri')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('matiere.name')
                    ->label('Matière')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('chapitre.title')
                    ->label('Chapitre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('statut.name')
                    ->numeric()
                    ->label('Statut')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publier le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créer le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifier le')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information')
                ->schema([
                    TextEntry::make('matiere.name')
                        ->label('Matière'),
                    TextEntry::make('chapitre.title')
                        ->label('Chapitre'),
                ]),


            Section::make('Contenu du Cours')
                ->schema([
                    TextEntry::make('lesson_numero')
                        ->label('Numero')
                        ->columnSpan(1),
                    TextEntry::make('title')
                        ->label('Titre')
                        ->columnSpan(5),
                    TextEntry::make('statut.name')
                        ->label("Le Statut")
                        ->columnSpan(1),
                    TextEntry::make('published_at')
                        ->label('Publier le')
                        ->columnSpan(2),
                    ImageEntry::make('image_uri')
                        ->label('Image')
                        ->columnSpan(3),
                ])->columns(6),

        ]);
    }

    public static function getRelations(): array
    {
        return [
            
            ContentsRelationManager::class,
            ObjectifsRelationManager::class,
            PreRequiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'view' => Pages\ViewLesson::route('/{record}'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
