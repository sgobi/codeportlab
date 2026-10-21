<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditRequestResource\Pages;
use App\Models\AuditRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AuditRequestResource extends Resource
{
    protected static ?string $model = AuditRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Lead Management';

    protected static ?string $navigationLabel = 'Audit Requests';

    protected static ?string $modelLabel = 'Audit Request';

    protected static ?string $pluralModelLabel = 'Audit Requests';

    protected static ?int $navigationSort = 1;

    /**
     * Disable creating audit requests manually since leads are inbound inquiries.
     */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lead Details')->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->disabled()
                        ->required(),

                    Forms\Components\TextInput::make('stack')
                        ->label('Requested Tech Stack')
                        ->disabled()
                        ->required(),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(fn (?AuditRequest $record): array => match ($record?->status) {
                            'sent' => ['sent' => 'Sent (Delivered)'],
                            default => [
                                'pending' => 'Pending',
                                'failed' => 'Failed',
                            ],
                        })
                        ->in(fn (?AuditRequest $record): array => match ($record?->status) {
                            'sent' => ['sent'],
                            default => ['pending', 'failed'],
                        })
                        ->disabled(fn (?AuditRequest $record): bool => $record?->status === 'sent')
                        ->helperText(fn (?AuditRequest $record): string => $record?->status === 'sent'
                            ? 'Notification was delivered. Sent status is locked to preserve delivery audit trail.'
                            : 'To mark as sent, use the "Retry Email" action which verifies actual email dispatch.'
                        )
                        ->required(),


                    Forms\Components\DateTimePicker::make('email_sent_at')
                        ->label('Email Sent At')
                        ->disabled(),

                    Forms\Components\DateTimePicker::make('created_at')
                        ->label('Submitted At')
                        ->disabled(),

                    Forms\Components\Textarea::make('scope')
                        ->label('Project Scope / Requirements')
                        ->rows(6)
                        ->disabled()
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Lead Information')->schema([
                    Infolists\Components\Grid::make(3)->schema([
                        Infolists\Components\TextEntry::make('id')
                            ->label('Lead ID'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email Address')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('stack')
                            ->label('Requested Stack'),
                    ]),

                    Infolists\Components\Grid::make(3)->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'sent' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Submitted At')
                            ->dateTime(),

                        Infolists\Components\TextEntry::make('email_sent_at')
                            ->label('Email Sent At')
                            ->dateTime()
                            ->placeholder('Not sent'),
                    ]),

                    Infolists\Components\TextEntry::make('scope')
                        ->label('Project Scope / Requirements')
                        ->columnSpanFull()
                        ->placeholder('No scope details provided.'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('stack')
                    ->label('Tech Stack')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'sent' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email_sent_at')
                    ->label('Email Sent At')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Not sent'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'sent' => 'Sent',
                        'failed' => 'Failed',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Submitted from'),
                        Forms\Components\DatePicker::make('created_until')->label('Submitted until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('retryEmail')
                    ->label('Retry Email')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Retry Email Notification')
                    ->modalDescription('Are you sure you want to retry sending the notification email for this lead?')
                    ->modalSubmitActionLabel('Yes, retry send')
                    ->visible(fn (AuditRequest $record): bool => $record->status === 'failed')
                    ->action(function (AuditRequest $record) {
                        if ($record->status === 'sent') {
                            Notification::make()
                                ->title('Notification email was already sent.')
                                ->warning()
                                ->send();
                            return;
                        }

                        $success = $record->sendNotification();
                        if ($success) {
                            Notification::make()
                                ->title('Notification email sent successfully.')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to send notification email. Please check mail logs.')
                                ->danger()
                                ->send();
                        }
                    }),
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
            'index' => Pages\ListAuditRequests::route('/'),
            'view' => Pages\ViewAuditRequest::route('/{record}'),
            'edit' => Pages\EditAuditRequest::route('/{record}/edit'),
        ];
    }
}
