<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'stack',
        'scope',
        'status',
        'email_sent_at',
    ];

    protected $casts = [
        'email_sent_at' => 'datetime',
    ];

    /**
     * Dispatch notification email for this audit request and update status accordingly.
     *
     * @return bool True if mail was dispatched and status updated to sent, false on failure.
     */
    public function sendNotification(): bool
    {
        // Guard against duplicate send operations for already dispatched leads
        if ($this->status === 'sent' && $this->email_sent_at !== null) {
            return true;
        }

        try {
            $siteProfile = SiteProfile::getActive();
            $recipient = $siteProfile?->email ?: 'gobi@codeportlab.com';

            \Illuminate\Support\Facades\Mail::raw(
                "New Infrastructure Audit Request:\n\nEmail: {$this->email}\nCloud/Stack: {$this->stack}\nScope: " . ($this->scope ?? 'None provided'),
                function ($message) use ($recipient) {
                    $message->to($recipient)
                        ->replyTo($this->email)
                        ->subject('New Infrastructure Audit Request - CodePortLab');
                }
            );

            $this->update([
                'status' => 'sent',
                'email_sent_at' => now(),
            ]);

            return true;
        } catch (\Throwable $e) {
            $this->update([
                'status' => 'failed',
            ]);

            \Illuminate\Support\Facades\Log::error('Inbound audit notification dispatch failed for audit request ID ' . $this->id, [
                'error_code' => $e->getCode(),
            ]);

            return false;
        }
    }
}

