<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\Cours\Partie\Content;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\Partie\ContentResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\ContentResource\RelationManagers;

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
                            Forms\Components\TextInput::make('section_title')
                            ->label('Titre de la Section')
                                ->columnSpan(2),
                            Forms\Components\Select::make('lesson_id')
                                ->relationship('lesson', 'title')
                                ->label('Leçon')
                                ->required(),
                            Forms\Components\Select::make('matiere_id')
                                ->relationship('matiere', 'name')
                                ->label('Matière')
                                ->required(),
                            Forms\Components\Select::make('niveau_id')
                                ->relationship('niveau', 'name')
                                ->label('Niveau')
                                ->required(),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label('Auteur')
                                ->required(),
                        ])->columns(2),


                    Wizard\Step::make('Contenu du Cours')
                        ->schema([
                            Forms\Components\RichEditor::make('content')
                                ->required()
                                ->label('Le contenu du cours')
                                ->label('Auteur')
                                ->columnSpanFull(),
                        ])->columns(2),
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

    public static function infolist(Infolist $infolist):Infolist{
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
