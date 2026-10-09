<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductizedSolutionResource\Pages;
use App\Filament\Resources\ProductizedSolutionResource\RelationManagers;
use App\Models\ProductizedSolution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductizedSolutionResource extends Resource
{
    protected static ?string $model = ProductizedSolution::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Portfolio CMS';
    protected static ?string $navigationLabel = 'Productized DevOps & Cloud Solutions';
    protected static ?string $modelLabel = 'Solution';
    protected static ?string $pluralModelLabel = 'Productized DevOps & Cloud Solutions';
    protected static ?int $navigationSort = 5;



    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('icon_text')->maxLength(10)->required()
                ->helperText('எ.கா. >_  #  ::'),
            Forms\Components\TextInput::make('title')->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    if (blank($get('slug'))) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }
                }),
            Forms\Components\TextInput::make('slug')->required()
                ->unique(ignoreRecord: true)
                ->helperText('Section id, எ.கா. service-cloud-architecture'),
            Forms\Components\Textarea::make('description')->rows(4)->required()->columnSpanFull(),
            Forms\Components\TextInput::make('link_label')->required()
                ->helperText('எ.கா. Request Audit'),
            Forms\Components\TextInput::make('link_url')->required()
                ->helperText('எ.கா. #contact அல்லது https://...'),
            Forms\Components\Toggle::make('opens_modal')
                ->label('Open audit modal instead of link'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ])->columns(2);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon_text'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('link_label'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductizedSolutions::route('/'),
            'create' => Pages\CreateProductizedSolution::route('/create'),
            'edit' => Pages\EditProductizedSolution::route('/{record}/edit'),
        ];
    }
}
