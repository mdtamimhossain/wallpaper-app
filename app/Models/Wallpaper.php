<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    use HasFactory;

    protected $fillable =[
        'image',
        'image_size',
        'category_id',
    ];
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Scope to retrieve popular wallpapers
    public function scopePopular($query)
    {
        return $query->orderBy('likes', 'desc');
    }
}
