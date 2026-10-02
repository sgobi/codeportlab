<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteProfileResource\Pages;
use App\Models\SiteProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteProfileResource extends Resource
{
    protected static ?string $model = SiteProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Portfolio CMS';

    protected static ?string $navigationLabel = 'Site Profile & Branding';

    protected static ?string $modelLabel = 'Site Profile';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Header & Branding')
                    ->description('Customize the top navbar logo, brand name, and subtitle.')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('brand_name')
                                ->label('Brand Name')
                                ->placeholder('CodePort')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('brand_accent')
                                ->label('Brand Accent (Highlighted)')
                                ->placeholder('Lab')
                                ->helperText('Displayed in highlight color (cyan)')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Forms\Components\TextInput::make('tagline')
                            ->label('Navbar Tagline')
                            ->placeholder('CLOUD & DEVOPS')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('logo_path')
                            ->label('Custom Brand Logo')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->helperText('Upload custom logo, or leave blank to use default logo.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Founder Profile (Footer)')
                    ->description('Manage founder personal branding, title, avatar, and geographic location.')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('founder_name')
                                ->label('Founder Name')
                                ->placeholder('Gobikrishna Subramaniyam')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('founder_title')
                                ->label('Founder Title')
                                ->placeholder('Founder & Senior Cloud Architect @ CodePortLab')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('founder_initials')
                                ->label('Avatar Initials')
                                ->placeholder('GS')
                                ->maxLength(4)
                                ->helperText('Shown when no headshot image is uploaded.'),

                            Forms\Components\TextInput::make('location')
                                ->label('Location & Timezone')
                                ->placeholder('Jaffna, Sri Lanka / UTC+5:30')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Forms\Components\FileUpload::make('founder_avatar')
                            ->label('Founder Avatar / Headshot')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->helperText('Optional profile photo. Replaces initials circle in footer.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Social Proof & Direct Contact')
                    ->description('Links to public profiles, social channels, and direct contact methods.')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('email')
                                ->label('Contact Email')
                                ->placeholder('gobi@codeportlab.com')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('phone')
                                ->label('Direct Phone / WhatsApp')
                                ->placeholder('+94 77 123 4567')
                                ->tel()
                                ->maxLength(50),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('github_url')
                                ->label('GitHub Profile URL')
                                ->placeholder('https://github.com/gobik1990')
                                ->url()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('linkedin_url')
                                ->label('LinkedIn Profile URL')
                                ->placeholder('https://www.linkedin.com/in/...')
                                ->url()
                                ->maxLength(255),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('medium_url')
                                ->label('Medium / Blog URL')
                                ->placeholder('https://medium.com/@...')
                                ->url()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('twitter_url')
                                ->label('X (Twitter) Profile URL')
                                ->placeholder('https://x.com/...')
                                ->url()
                                ->maxLength(255),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('youtube_url')
                                ->label('YouTube Channel URL')
                                ->placeholder('https://youtube.com/@...')
                                ->url()
                                ->maxLength(255),
                        ]),

                        Forms\Components\Repeater::make('custom_social_links')
                            ->label('Additional Social & Community Links')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Platform / Title')
                                    ->placeholder('e.g. Discord, Substack, Calendly, Dev.to')
                                    ->required(),

                                Forms\Components\TextInput::make('url')
                                    ->label('Target URL')
                                    ->placeholder('https://...')
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Add Another Social Proof Link')
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Footer Notice & Publication Status')
                    ->schema([
                        Forms\Components\TextInput::make('copyright_text')
                            ->label('Copyright Statement')
                            ->placeholder('CodePortLab. Cloud & DevOps B2B Consulting.')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Site Profile')
                            ->helperText('When enabled, public visitors will see these details.')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->defaultImageUrl(asset('images/logo.png'))
                    ->circular(),

                Tables\Columns\TextColumn::make('brand_name')
                    ->label('Brand')
                    ->formatStateUsing(fn ($record) => $record->brand_name . $record->brand_accent)
                    ->description(fn ($record) => $record->tagline)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('founder_name')
                    ->label('Founder')
                    ->description(fn ($record) => $record->founder_title)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => Pages\ListSiteProfiles::route('/'),
            'create' => Pages\CreateSiteProfile::route('/create'),
            'edit' => Pages\EditSiteProfile::route('/{record}/edit'),
        ];
    }
}
