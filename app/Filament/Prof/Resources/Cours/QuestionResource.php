<?php

namespace App\Filament\Prof\Resources\Cours;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Cours\Question;
use App\Models\Cours\Evaluation;
use Filament\Resources\Resource;
use App\Models\Cours\TypeQuestion;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\QuestionResource\Pages;
use App\Filament\Prof\Resources\Cours\QuestionResource\RelationManagers;
use App\Filament\Prof\Resources\ExerciceResource\RelationManagers\QuestionsRelationManager;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Exercice - Evaluation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Information')->schema([
                        Forms\Components\Select::make('type_question_id')
                            ->options(TypeQuestion::all()->pluck('name','id'))
                            ->label("Type de question")
                            ->required()
                            ->native(false)
                            ->default(1),
                        Forms\Components\Select::make('evaluation_id')
                            ->options(Evaluation::all_evaluations()->pluck('title','id'))
                            ->label("Evaluation")
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->options([auth()->user()->id=>auth()->user()->name])
                            ->default(auth()->user()->id)
                            ->label("Auteur")
                            ->native(false)
                            ->required(),
                    ])->columns(3),

                    Wizard\Step::make('Question')->schema([
                        Forms\Components\TextInput::make('text')
                        ->label("Question text")
                            ->required()
                            ->columnSpan(5),
                        Forms\Components\TextInput::make('point')
                        ->label('point')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->columnSpan(1),
                    ])->columns(6),

                    Wizard\Step::make('Reponse ou Options')->schema([
                        Forms\Components\Repeater::make('options')
                            ->schema([
                                Forms\Components\TextInput::make('response_text')
                                    ->required()
                                    ->columnSpan(5),
                                Forms\Components\Toggle::make('is_correct')
                                ->columnSpan(1),
                            ])->columns(6)
                            ->required(),
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_question_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evaluation_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'view' => Pages\ViewQuestion::route('/{record}'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
