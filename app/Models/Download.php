<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Download extends Model
{
    /** @use HasFactory<\Database\Factories\DownloadFactory> */
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function item(): MorphOne
    {
        return $this->morphOne(Item::class, 'content');
    }
}
