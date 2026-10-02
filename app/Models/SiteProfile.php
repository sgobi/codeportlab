<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'brand_accent',
        'tagline',
        'logo_path',
        'founder_name',
        'founder_title',
        'founder_initials',
        'founder_avatar',
        'location',
        'email',
        'phone',
        'github_url',
        'linkedin_url',
        'medium_url',
        'twitter_url',
        'youtube_url',
        'custom_social_links',
        'copyright_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'custom_social_links' => 'array',
    ];

    /**
     * Get the active site profile or fallback to a default instance.
     */
    public static function getActive(): self
    {
        $active = static::where('is_active', true)->latest()->first();

        if ($active) {
            return $active;
        }

        $any = static::latest()->first();

        return $any ?? new static([
            'brand_name' => 'CodePort',
            'brand_accent' => 'Lab',
            'tagline' => 'CLOUD & DEVOPS',
            'founder_name' => 'Gobikrishna Subramaniyam',
            'founder_title' => 'Founder & Senior Cloud Architect @ CodePortLab',
            'founder_initials' => 'GS',
            'location' => 'Jaffna, Sri Lanka / UTC+5:30',
            'email' => 'gobikrishnasubramaniyam@hotmail.com',
            'github_url' => 'https://github.com/gobik1990',
            'linkedin_url' => 'https://www.linkedin.com/in/gobikrishna-subramaniyam',
            'medium_url' => 'https://medium.com/@gobik1990',
            'copyright_text' => 'CodePortLab. Cloud & DevOps B2B Consulting.',
            'is_active' => true,
        ]);
    }

    /**
     * Get public URL for logo.
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo_path) {
            return Storage::disk('public')->url($this->logo_path);
        }

        return asset('images/logo.png');
    }

    /**
     * Get public URL for avatar.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->founder_avatar) {
            return Storage::disk('public')->url($this->founder_avatar);
        }

        return null;
    }

    /**
     * Get consolidated list of all social proof and community links.
     */
    public function getAllSocialLinksAttribute(): array
    {
        $links = [];

        if (!empty($this->github_url)) {
            $links[] = ['label' => 'GitHub', 'url' => $this->github_url];
        }

        if (!empty($this->linkedin_url)) {
            $links[] = ['label' => 'LinkedIn', 'url' => $this->linkedin_url];
        }

        if (!empty($this->medium_url)) {
            $links[] = ['label' => 'Medium', 'url' => $this->medium_url];
        }

        if (!empty($this->twitter_url)) {
            $links[] = ['label' => 'X / Twitter', 'url' => $this->twitter_url];
        }

        if (!empty($this->youtube_url)) {
            $links[] = ['label' => 'YouTube', 'url' => $this->youtube_url];
        }

        if (is_array($this->custom_social_links)) {
            foreach ($this->custom_social_links as $item) {
                if (!empty($item['url']) && !empty($item['label'])) {
                    $links[] = [
                        'label' => $item['label'],
                        'url' => $item['url'],
                    ];
                }
            }
        }

        return $links;
    }
}
