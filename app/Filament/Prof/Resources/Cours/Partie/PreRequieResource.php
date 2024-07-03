<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use App\Models\Matiere;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Partie\Chapitre;
use Filament\Forms\Components\Wizard;
use App\Models\Cours\Partie\PreRequie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\Partie\PreRequieResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\PreRequieResource\RelationManagers;

class PreRequieResource extends Resource
{
    protected static ?string $model = PreRequie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Gestion des Leçon';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Wizard::make([
                    wizard\Step::make("Leçon")
                        ->description("Information de la leçon")
                        ->schema([
                            Forms\Components\Select::make('matiere_id')
                            ->options(Matiere::all()->pluck('name','id'))
                                ->afterStateUpdated(fn (Set $set) => $set('chapitre_id', null))
                                ->live()
                                ->native(False)
                                ->preload()
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make('chapitre_id')
                                ->options(fn (Get $get): Collection => Chapitre::query()->where('matiere_id', $get('matiere_id'))->get()->pluck('title', 'id'))
                                ->afterStateUpdated(fn (Set $set) => $set('lesson_id', null))->live()
                                ->native(False)
                                ->preload()
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make('lesson_id')
                                ->options(fn (Get $get): Collection => Lesson::query()->where('chapitre_id', $get('chapitre_id'))->get()->pluck('title', 'id'))
                                ->native(False)
                                ->preload()
                                ->searchable()
                                ->required()
                                ->columnSpanFull(),

                        ])->columns(2),

                    wizard\Step::make("Objectif")
                        ->description("Information de l'Objectif")
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required(),
                            Forms\Components\TextInput::make('liens'),
                            Forms\Components\Textarea::make('description')
                                ->columnSpanFull(),
                        ])->columns(2),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('liens')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('chapitre.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matiere.name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPreRequies::route('/'),
            'create' => Pages\CreatePreRequie::route('/create'),
            'view' => Pages\ViewPreRequie::route('/{record}'),
            'edit' => Pages\EditPreRequie::route('/{record}/edit'),
        ];
    }
}
