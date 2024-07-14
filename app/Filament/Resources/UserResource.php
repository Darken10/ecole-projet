<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    wizard\Step::make('Information Personnel')
                        ->schema([
                            Forms\Components\TextInput::make('first_name')
                                ->minLength(2)
                                ->required(),
                            Forms\Components\TextInput::make('last_name')
                                ->minLength(2)
                                ->required(),
                            Forms\Components\DatePicker::make('date_naissance')
                                ->required(),
                            Forms\Components\Select::make('sexe')
                                ->options(['Homme' => 'Homme', 'Femme' => 'Femme'])
                                ->native(false)
                                ->required(),
                        ])->columns(2),

                    wizard\Step::make('Adresse')
                        ->schema([
                            Forms\Components\TextInput::make('numero')
                                ->tel()
                                ->minLength(8)
                                ->maxLength(16)
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required(),
                        ]),
                    wizard\Step::make('Information Suplementaire')
                        ->schema([
                            Forms\Components\FileUpload::make('profile_uri')
                                ->label("Photo de Profile")
                                ->image()
                                ->columnSpanFull(),
                            Forms\Components\Select::make('statut_id')
                                ->relationship('statut', 'name')
                                ->label("Le Statut")
                                ->required()
                                ->native(False),
                            Forms\Components\Select::make('niveau_id')
                                ->relationship('niveau', 'name')
                                ->label("Niveau")
                                ->required()
                                ->native(False),
                        ])->columns(2),
                    wizard\Step::make('Mot de Passe')
                        ->schema([
                            //Forms\Components\DateTimePicker::make('email_verified_at'),
                            Forms\Components\TextInput::make('password')
                                ->password()
                                ->required(),
                        ]),
                ])->columnSpanFull(),





            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information personnel')
                ->schema([
                    TextEntry::make('first_name')->label('Nom'),
                    TextEntry::make('last_name')->label('Prenom'),
                    TextEntry::make('date_naissance')->label('Date de Naissance'),
                    TextEntry::make('sexe')->label('Genre'),
                ])->columns(2),
            
            Section::make('Adresse')
                ->schema([
                    TextEntry::make('numero')->label('Numero'),
                    TextEntry::make('email')->label('email'),
                ])->columns(2),

            Section::make('Information Suplementaire')
            ->schema([
                    TextEntry::make('statut.name')->label('Statut'),
                    TextEntry::make('niveau.name')->label('Niveau'),
                    ImageEntry::make('profile_uri')->label('Profile')->columnSpanFull(),
                ])->columns(2),
                        

        ]);
    }
    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
