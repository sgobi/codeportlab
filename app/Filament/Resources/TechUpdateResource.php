<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechUpdateResource\Pages;
use App\Models\TechUpdate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TechUpdateResource extends Resource
{
    protected static ?string $model = TechUpdate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Portfolio CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tech Update Details')->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('category')
                        ->options([
                            'DevOps & Cloud' => 'DevOps & Cloud',
                            'Full-Stack' => 'Full-Stack',
                            'AI & Tooling' => 'AI & Tooling',
                            'Architecture' => 'Architecture',
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('summary')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('external_url')
                        ->label('External URL')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Published At')
                        ->default(now()),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Toggle::make('is_pinned')
                            ->label('Pin to Top')
                            ->default(false),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Is Published')
                            ->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'DevOps & Cloud' => 'info',
                        'Full-Stack' => 'success',
                        'AI & Tooling' => 'warning',
                        'Architecture' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_pinned')
                    ->label('Pinned')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'DevOps & Cloud' => 'DevOps & Cloud',
                        'Full-Stack' => 'Full-Stack',
                        'AI & Tooling' => 'AI & Tooling',
                        'Architecture' => 'Architecture',
                    ]),
                Tables\Filters\TernaryFilter::make('is_pinned')
                    ->label('Pinned Only'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Only'),
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
            'index' => Pages\ListTechUpdates::route('/'),
            'create' => Pages\CreateTechUpdate::route('/create'),
            'edit' => Pages\EditTechUpdate::route('/{record}/edit'),
        ];
    }
}
