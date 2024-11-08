<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'name',
        'logo',
        'slogan',
        'description',
        'location',
        'min_price',
        'max_price',
        'status',
        'percent',
        'images',
    ];

    public static function booted()
    {
        static::creating(function (Property $record) {
            $record->id = Str::ulid();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
