<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $appends = [
        'type_icon'
    ];

    protected $guarded = [
        'id'
    ];

    public function getTypeIconAttribute($value): string
    {
        return match($this->content_type) {
            'info' => 'book-open',
            'WEBLINK' => 'external-link',
            'download' => 'download',
        };
    }

    public function content(): MorphTo
    {
        return $this->morphTo();
    }
}
