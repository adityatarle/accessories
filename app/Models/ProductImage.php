<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute()
    {
        // Check if it's an external URL (starts with http:// or https://)
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }
        
        return asset('storage/' . $this->image_path);
    }

    public function getThumbnailUrlAttribute()
    {
        // Check if it's an external URL (starts with http:// or https://)
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }
        
        $path = pathinfo($this->image_path);
        $thumbnailPath = $path['dirname'] . '/thumbnails/' . $path['filename'] . '_thumb.' . $path['extension'];
        return asset('storage/' . $thumbnailPath);
    }
}