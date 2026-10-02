<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'tech_stack',
        'description',
        'content',
        'live_url',
        'article_url',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => \Illuminate\Support\Facades\Cache::forget('portfolio_page_data'));
        static::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('portfolio_page_data'));
    }

    /**
     * Accessor to return tech_stack as an array of trimmed strings.
     *
     * @return array<int, string>
     */
    public function getTechStackArrayAttribute(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }

        return array_map('trim', explode(',', $this->tech_stack));
    }

    /**
     * Helper method to return tech stack array.
     *
     * @return array<int, string>
     */
    public function getTechStackArray(): array
    {
        return $this->tech_stack_array;
    }
}
