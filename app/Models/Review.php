<?php

namespace App\Models;

use App\Models\Product;
use App\Facades\Sentimentality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['sentimentality'];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }

    public function getSentimentalityAttribute()
    {
        return $this->sentimentality();
    }

    // Helper Function
    public function sentimentality()
    {
        $review_title_decision = isset($this->review_title) ? Sentimentality::decision($this->review_title) : null;
        $review_title_score = isset($this->review_title) ? Sentimentality::score($this->review_title) : null;
        $review_title_scores = isset($this->review_title) ? Sentimentality::scores($this->review_title) : null;

        $review_text_decision = isset($this->review_text) ? Sentimentality::decision($this->review_text) : null;
        $review_text_score = isset($this->review_text) ? Sentimentality::score($this->review_text) : null;
        $review_text_scores = isset($this->review_text) ? Sentimentality::scores($this->review_text) : null;

        $dominant_score = $review_title_score > $review_text_score ? $review_title_score : $review_text_score;
        $dominant_decision = $review_title_score > $review_text_score ? $review_title_decision : $review_text_decision;
        $dominant_sentiment_color = $this->sentimentalityColor($dominant_decision);

        return [
            'dominant_score' => $dominant_score,
            'dominant_decision' => $dominant_decision,
            'dominant_sentiment_color' => $dominant_sentiment_color,

            'review_title' => array(
                'color' => $this->sentimentalityColor($review_title_decision),
                'score' => $review_title_score ?? 0,
                'decision' => $review_title_decision,
                'scores' => $review_title_scores ?? null,
            ),
            'review_text' => array(
                'color' => $this->sentimentalityColor($review_text_decision),
                'score' => $review_text_score ?? 0,
                'decision' => $review_text_decision,
                'scores' => $review_text_scores,
            ),
        ];
    }

    private function sentimentalityColor($decision)
    {
        switch ($decision) {
            case 'negative':
                return 'danger';
            case 'positive':
                return 'success';
            case 'neutral':
                return 'warning';
            default:
                return 'primary';
        }
    }
}
