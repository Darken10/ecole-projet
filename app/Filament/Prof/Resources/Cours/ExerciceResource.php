<?php

namespace App\Filament\Prof\Resources\Cours;

use Filament\Forms;
use Filament\Tables;
use App\Models\Matiere;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\Niveau;
use App\Models\Cours\Exercice;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\ExerciceResource\Pages;
use App\Filament\Prof\Resources\Cours\ExerciceResource\RelationManagers;
use App\Filament\Prof\Resources\ExerciceResource\RelationManagers\QuestionsRelationManager;

class ExerciceResource extends Resource
{
    protected static ?string $model = Exercice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Exercice - Evaluation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Choix de la Section')
                        ->schema([
                            Forms\Components\Select::make('niveau_id')
                                ->options(Niveau::all()->pluck('name', 'id'))
                                ->label('Niveau')
                                ->preload()
                                ->searchable()
                                ->native(False),
                            Forms\Components\Select::make('matiere_id')
                                ->options(Matiere::all()->pluck('name', 'id'))
                                ->label('Matière')
                                ->live()
                                ->afterStateUpdated(fn (Set $set) => $set('chapitre_id', null))
                                ->preload()
                                ->searchable()
                                ->native(False),
                            Forms\Components\Select::make('chapitre_id')
                                ->options(fn (Get $get): Collection => Chapitre::query()->where('matiere_id', $get('matiere_id'))->get()->pluck('title', 'id'))
                                ->label("Le Chapitre")
                                ->afterStateUpdated(fn (Set $set) => $set('lesson_id', null))
                                ->live()
                                ->preload()
                                ->searchable()
                                ->native(False),
                            Forms\Components\Select::make('lesson_id')
                                ->options(fn (Get $get): Collection => Lesson::query()->where('chapitre_id', $get('chapitre_id'))->get()->pluck('title', 'id'))
                                ->afterStateUpdated(fn (Set $set) => $set('content_id', null))
                                ->live()
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->label('Leçon'),
                            Forms\Components\Select::make('content_id')
                                ->options(fn (Get $get): Collection => Content::query()->where('lesson_id', $get('lesson_id'))->get()->pluck('section_title', 'id'))
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->label('Section')
                                ->required(),

                        ])->columns(2),

                    Wizard\Step::make('Creation')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\Textarea::make('description')
                                ->columnSpanFull(),

                            Forms\Components\Select::make('statut_id')
                                ->relationship('statut', 'name')
                                ->required(),
                        ]),


                    Wizard\Step::make('Questions')
                        ->schema([
                            Forms\Components\Section::make('questions')
                                ->schema([
                                    Forms\Components\Repeater::make('questions')
                                        ->schema([
                                            Forms\Components\TextInput::make('question_text')
                                                ->required(),

                                            Forms\Components\Section::make('Reponses')
                                                ->schema([
                                                    Forms\Components\Repeater::make('options')
                                                        ->schema([
                                                            Forms\Components\TextInput::make('response_text')
                                                                ->required()
                                                                ->columnSpan(5),
                                                            Forms\Components\Toggle::make('is_correct')
                                                                ->required()
                                                                ->columnSpan(1),
                                                        ])->columns(6)->required(),
                                                ]),
                                        ])
                                        ->required(),
                                ]),
                        ]),
                ])->columnSpanFull(),





            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content.section_title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut.name')
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
                Tables\Actions\DeleteAction::make(),
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
                    TextEntry::make('title')
                        ->label('Titre ')
                        ->columnSpan(2),
                    TextEntry::make('description')
                        ->label('Description'),
                    TextEntry::make('statut.name')
                        ->label('Statut'),
                    TextEntry::make('content.section_title')
                        ->label('Section'),
                ])->columns(2),


            Section::make('Les Question')
                ->schema([
                    RepeatableEntry::make('questions')
                        ->label('Les Questions')
                        ->schema([
                            TextEntry::make('question_text')
                                ->label('Question'),
                            RepeatableEntry::make('options')
                                ->label('Les Options')
                                ->schema([
                                    TextEntry::make('response_text')
                                        ->label('Reponses ')
                                        ->columnSpan(4),
                                    TextEntry::make('is_correct')
                                        ->label('etre Correct')
                                        ->columnSpan(1),
                                ])->columns(5)
                        ])
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExercices::route('/'),
            'create' => Pages\CreateExercice::route('/create'),
            'view' => Pages\ViewExercice::route('/{record}'),
            'edit' => Pages\EditExercice::route('/{record}/edit'),
        ];
    }
}
