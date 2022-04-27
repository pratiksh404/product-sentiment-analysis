<?php

namespace App\Models;

use App\Models\Review;
use App\Facades\Sentimentality;
use App\Services\ProductSentimentality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $casts = [
        'categories' => 'array',
    ];

    protected $appends = ['product_sentimentality'];

    // Accessors
    public function getProductSentimentalityAttribute()
    {
        return new ProductSentimentality($this);
    }

    // Relationships
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_uuid', 'uuid');
    }
}
