<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use App\Models\Matiere;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\Niveau;
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
use App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\ContentResource\RelationManagers;
use App\Filament\Prof\Resources\LessonResource\RelationManagers\ContentsRelationManager;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Gestion des Leçon';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Information')
                        ->schema([
                            Forms\Components\Select::make('niveau_id')
                                ->options(Niveau::all()->pluck('name', 'id'))
                                ->afterStateUpdated(fn (Set $set) => $set('matiere_id', null))
                                ->label('Niveau')
                                ->live()
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->hiddenOn(ContentsRelationManager::class),
                            Forms\Components\Select::make('matiere_id')
                                ->options(fn (Get $get): Collection|null => Niveau::find($get('niveau_id'))?->matieres?->pluck('name', 'id'))
                                ->label('Matière')
                                ->live()
                                ->afterStateUpdated(fn (Set $set) => $set('chapitre_id', null))
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->hiddenOn(ContentsRelationManager::class),
                            Forms\Components\Select::make('chapitre_id')
                                ->options(fn (Get $get): Collection => Chapitre::query()->where('niveau_id', $get('niveau_id'))->where('matiere_id', $get('matiere_id'))->get()->pluck('title', 'id'))
                                ->label("Le Chapitre")
                                ->live()
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->hiddenOn(ContentsRelationManager::class),
                            Forms\Components\Select::make('lesson_id')
                                ->options(fn (Get $get): Collection => Lesson::query()->where('chapitre_id', $get('chapitre_id'))->get()->pluck('title', 'id'))
                                ->afterStateUpdated(fn (Get $get, Set $set) => $set('numero_section', Content::query()->where('lesson_id', (int)$get('lesson_id'))->get()->last()?->numero_section + 1 ?? 1))
                                ->live()
                                ->preload()
                                ->searchable()
                                ->native(False)
                                ->label('Leçon')
                                ->hiddenOn(ContentsRelationManager::class)
                                ->required(),

                            /* Forms\Components\Select::make('user_id')
                                ->options([auth()->user()->id => auth()->user()->name])
                                ->default(auth()->user()->id)
                                ->required(), */
                            
                        ])->columns(2),


                    Wizard\Step::make('Contenu du Cours')
                        ->schema([
                            Forms\Components\TextInput::make('numero_section')
                                ->label('N°')
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('section_title')
                                ->label('Titre de la Section')
                                ->columnSpan(5),
                            Forms\Components\RichEditor::make('content')
                                ->required()
                                ->label('Le contenu du cours')
                                ->columnSpanFull(),
                        ])->columns(6),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matiere.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('niveau.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information')
                ->schema([
                    TextEntry::make('section_title')
                        ->label('Titre de la Section')
                        ->columnSpan(2),
                    TextEntry::make('lesson.title')
                        ->label('Leçon'),
                    TextEntry::make('matiere.name')
                        ->label('Matière'),
                    TextEntry::make('niveau.name')
                        ->label('Niveau'),
                    TextEntry::make('user.name')
                        ->label('Auteur'),
                ])->columns(2),


            Section::make('Contenu du Cours')
                ->schema([
                    TextEntry::make('content')
                        ->label('Le contenu du cours')
                        ->html()
                        ->columnSpanFull(),
                ])->columns(2),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'view' => Pages\ViewContent::route('/{record}'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
