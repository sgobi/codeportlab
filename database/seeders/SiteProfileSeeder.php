<?php

namespace Database\Seeders;

use App\Models\SiteProfile;
use Illuminate\Database\Seeder;

class SiteProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteProfile::updateOrCreate(
            ['brand_name' => 'CodePort', 'brand_accent' => 'Lab'],
            [
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
            ]
        );
    }
}
