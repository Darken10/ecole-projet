<?php

namespace App\Filament\Prof\Resources\Cours;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\Niveau;
use App\Models\Cours\Evaluation;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\EvaluationResource\Pages;
use App\Filament\Prof\Resources\Cours\EvaluationResource\RelationManagers;
use App\Filament\Prof\Resources\LessonResource\RelationManagers\EvaluationsRelationManager;
use App\Filament\Prof\Resources\EvaluationResource\RelationManagers\QuestionsRelationManager;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Wizard\Step::make('Choix de la leçon')->schema([
                        Forms\Components\Select::make('niveau_id')
                            ->options(Niveau::all()->pluck('name', 'id'))
                            ->afterStateUpdated(fn (Set $set) => $set('matiere_id', null))
                            ->label('Niveau')
                            ->live()
                            ->preload()
                            ->searchable()
                            ->native(False)
                            ->hiddenOn(EvaluationsRelationManager::class),
                        Forms\Components\Select::make('matiere_id')
                            ->options(fn (Get $get): Collection|null => Niveau::find($get('niveau_id'))?->matieres?->pluck('name', 'id'))
                            ->label('Matière')
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('chapitre_id', null))
                            ->preload()
                            ->searchable()
                            ->native(False)
                            ->hiddenOn(EvaluationsRelationManager::class),
                        Forms\Components\Select::make('chapitre_id')
                            ->options(fn (Get $get): Collection => Chapitre::query()->where('niveau_id', $get('niveau_id'))->where('matiere_id', $get('matiere_id'))->get()->pluck('title', 'id'))
                            ->label("Le Chapitre")
                            ->live()
                            ->preload()
                            ->searchable()
                            ->native(False)
                            ->hiddenOn(EvaluationsRelationManager::class),
                        Forms\Components\Select::make('lesson_id')
                            ->options(fn (Get $get): Collection => Lesson::query()->where('chapitre_id', $get('chapitre_id'))->get()->pluck('title', 'id'))
                            ->live()
                            ->preload()
                            ->searchable()
                            ->native(False)
                            ->label('Leçon')
                            ->hiddenOn(EvaluationsRelationManager::class)
                            ->required(),

                    ])->columns(2),

                    Wizard\Step::make('Informations')->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('cote')
                            ->required()
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('time')
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->options([auth()->user()->id => auth()->user()->name])
                            ->default(auth()->user()->id)
                            ->required(),
                        Forms\Components\Select::make('statut_id')
                            ->relationship('statut', 'name')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),

                    ]),
                    //Wizard\Step::make('')->schema([]),
                ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cote')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
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
            Section::make('Information de la leçon')
                ->schema([
                    TextEntry::make('title')->label('Titre'),
                    TextEntry::make('lesson.title')->label('Leçon'),
                    TextEntry::make('lesson.chapitre.title')->label('Chapitre'),
                    TextEntry::make('lesson.chapitre.matiere.name')->label('Matiere'),
                    TextEntry::make('lesson.chapitre.niveau.name')->label('Niveau'),
                ])->columns(2),


            Section::make('Information de l\'evaluation')
                ->schema([
                    TextEntry::make('title')
                        ->label('Titre')
                        ->columnSpan(5),
                    TextEntry::make('cote')
                        ->label('La coefficient')
                        ->columnSpan(1),
                    TextEntry::make('description')
                        ->label('La Description')
                        ->columnSpan(6),
                    TextEntry::make('statut.name')
                        ->label("Le Statut")
                        ->columnSpan(3),

                    TextEntry::make('time')
                        ->label('La Dure')
                        ->columnSpan(3),


                ])->columns(6),

        ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluation::route('/create'),
            'view' => Pages\ViewEvaluation::route('/{record}'),
            'edit' => Pages\EditEvaluation::route('/{record}/edit'),
        ];
    }
}
