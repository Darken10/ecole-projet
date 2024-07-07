<?php

namespace App\Filament\Prof\Resources\Cours\Partie;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\Cours\Partie\UserQuestion;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource\Pages;
use App\Filament\Prof\Resources\Cours\Partie\UserQuestionResource\RelationManagers;
use App\Filament\Prof\Resources\UserQuestionResource\RelationManagers\UserQuestionResponsesRelationManager;

class UserQuestionResource extends Resource
{
    protected static ?string $model = UserQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Question'),
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
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                //])

            ])->headerActions([]);
    }

    public static function getRelations(): array
    {
        return [
            UserQuestionResponsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserQuestions::route('/'),
            //'create' => Pages\CreateUserQuestion::route('/create'),
            'view' => Pages\ViewUserQuestion::route('/{record}'),
            //'edit' => Pages\EditUserQuestion::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information')
                ->schema([
                    TextEntry::make('user.name')
                        ->label('Utilisateur'),
                    TextEntry::make('lesson.title')
                        ->label('Leçon'),
                    TextEntry::make('Question')
                        ->label('Question')
                        ->columnSpanFull(),
                ])
                ->columns(2),

        ]);
    }
}
