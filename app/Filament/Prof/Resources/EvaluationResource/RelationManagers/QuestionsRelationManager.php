<?php

namespace App\Filament\Prof\Resources\EvaluationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('text')
                ->label('La question')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('point')
                    ->required()
                    ->numeric()
                    ->default(1),

                Forms\Components\Repeater::make('options')
                    ->label('Les Options')
                    ->schema([
                        Forms\Components\TextInput::make('text')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_correct')
                        ->label('est correcte'),
                        Forms\Components\Textarea::make('justification')
                            ->label('justification')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('text')
            ->columns([
                Tables\Columns\TextColumn::make('text'),
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
