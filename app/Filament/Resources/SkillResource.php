<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Portfolio CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Skill Information')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('group')
                        ->options([
                            'Cloud & Infrastructure' => 'Cloud & Infrastructure',
                            'Containers & CI/CD' => 'Containers & CI/CD',
                            'Backend & Web' => 'Backend & Web',
                            'Databases & Ops' => 'Databases & Ops',
                        ])
                        ->required(),

                    Forms\Components\Select::make('proficiency')
                        ->options([
                            'Expert' => 'Expert',
                            'Advanced' => 'Advanced',
                            'Proficient' => 'Proficient',
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Cloud & Infrastructure' => 'primary',
                        'Containers & CI/CD' => 'warning',
                        'Backend & Web' => 'success',
                        'Databases & Ops' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('proficiency')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Expert' => 'success',
                        'Advanced' => 'info',
                        'Proficient' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'Cloud & Infrastructure' => 'Cloud & Infrastructure',
                        'Containers & CI/CD' => 'Containers & CI/CD',
                        'Backend & Web' => 'Backend & Web',
                        'Databases & Ops' => 'Databases & Ops',
                    ]),
                Tables\Filters\SelectFilter::make('proficiency')
                    ->options([
                        'Expert' => 'Expert',
                        'Advanced' => 'Advanced',
                        'Proficient' => 'Proficient',
                    ]),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
