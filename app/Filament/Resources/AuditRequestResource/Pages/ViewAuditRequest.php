<?php

namespace App\Filament\Resources\AuditRequestResource\Pages;

use App\Filament\Resources\AuditRequestResource;
use App\Models\AuditRequest;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewAuditRequest extends ViewRecord
{
    protected static string $resource = AuditRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('retryEmail')
                ->label('Retry Email')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Retry Email Notification')
                ->modalDescription('Are you sure you want to retry sending the notification email for this lead?')
                ->modalSubmitActionLabel('Yes, retry send')
                ->visible(fn (): bool => $this->record->status === 'failed')
                ->action(function () {
                    /** @var AuditRequest $record */
                    $record = $this->record;

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
        ];
    }
}
