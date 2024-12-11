<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'color',
        'sort',
        'is_show',
    ];

    protected $casts = [
        'is_show' => 'boolean',
    ];

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }
}