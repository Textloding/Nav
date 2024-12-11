<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'sort_order',
        'is_show',
    ];

    protected $casts = [
        'is_show' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function sites()
    {
        return $this->hasMany(Site::class)->orderBy('sort_order');
    }
}