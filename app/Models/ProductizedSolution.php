<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductizedSolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon_text',
        'title',
        'description',
        'link_label',
        'link_url',
        'sort_order',
        'is_active',
        'slug',
        'opens_modal',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'opens_modal' => 'boolean',
    ];
}