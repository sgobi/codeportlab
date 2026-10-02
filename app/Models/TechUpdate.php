<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechUpdate extends Model
{
    use HasFactory;

    protected $table = 'tech_updates';

    protected $fillable = [
        'title',
        'category',
        'summary',
        'content',
        'external_url',
        'is_pinned',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => \Illuminate\Support\Facades\Cache::forget('portfolio_page_data'));
        static::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('portfolio_page_data'));
    }
}
