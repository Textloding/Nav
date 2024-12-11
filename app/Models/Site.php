<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'url',
        'logo',
        'description',
        'sort_order',
        'is_show',
    ];

    protected $casts = [
        'is_show' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}