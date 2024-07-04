<?php

namespace App\Filament\Prof\Resources\LessonResource\RelationManagers;

use App\Filament\Prof\Resources\Cours\Partie\ContentResource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\Partie\Content;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ContentsRelationManager extends RelationManager
{
    protected static string $relationship = 'contents';

    public function form(Form $form): Form
    {
        return ContentResource::form($form);
            /*->schema([
                Forms\Components\TextInput::make('numero_section')
                    ->label('N°')
                    ->default(fn (Get $get): int|null => dd($get('lesson_id')))
                    ->columnSpan(1),
                Forms\Components\TextInput::make('section_title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(3),
                Forms\Components\Select::make('user_id')
                    ->options([auth()->user()->id => auth()->user()->name])
                    ->default(auth()->user()->id)
                    ->native(false)
                    ->required()
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->label('Le contenu du cours')
                    ->label('Auteur')
                    ->columnSpanFull(),
            ])->columns(6);*/
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('section_title')
            ->columns([
                Tables\Columns\TextColumn::make('section_title'),
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
