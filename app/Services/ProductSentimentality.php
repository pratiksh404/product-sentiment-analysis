<?php

namespace App\Services;

use App\Models\Product;

class ProductSentimentality
{
    // Sentimentality Class
    const NEGATIVE = 'negative';
    const NEUTRAL = 'neutral';
    const POSITIVE = 'positive';

    const SENTIMENT_CLASSES = [
        self::NEGATIVE,
        self::NEUTRAL,
        self::POSITIVE,
    ];

    public $product;
    public $result = array();
    public $product_review_sentimentalities = array();
    public $dominant_sentiment_class = array();
    public $sentiment_class_occurrence = array();
    public $positive_score = 0;
    public $negative_score = 0;
    public $neutral_score = 0;
    public $dominant_decision = '';
    public $dominant_sentiment_color = '';
    public $dominant_score = 0;


    public function __construct(Product $product)
    {
        $this->product = $product;
        // Assigning All Product Review Sentimentalities
        $this->collectProductReviewSentimentalities();
        // Set Product Positive Sentimentality Attributes
        $this->setSentimentClassAttributes();
    }

    private function setSentimentClassAttributes()
    {
        // Initialization
        $positive_score = 0;
        $negative_score = 0;
        $neutral_score = 0;
        $sentiment_class_occurrence = array();

        $product_review_sentimentalities = $this->product_review_sentimentalities;
        // Array of Sentiment Classes Frequency of Occurrence
        $all_dominant_decision = array_column($product_review_sentimentalities, 'dominant_decision');
        $sentiment_class_occurrence = array_count_values($all_dominant_decision);
        arsort($sentiment_class_occurrence);
        $this->sentiment_class_occurrence = $sentiment_class_occurrence;

        foreach ($product_review_sentimentalities as $sentimentality) {
            $dominant_decision = $sentimentality['dominant_decision'];
            switch ($dominant_decision) {
                case 'positive':
                    $positive_score += $sentimentality['dominant_score'];
                    break;
                case 'negative':
                    $negative_score += $sentimentality['dominant_score'];
                    break;
                case 'neutral':
                    $neutral_score += $sentimentality['dominant_score'];
                    break;
                default:
                    throw new Exception("Undefined Sentiment Decision Class");
                    break;
            }
        }

        // Set Product Positive Sentimentality Attributes
        if (array_key_exists(self::POSITIVE, $sentiment_class_occurrence)) {
            $this->positive_score = (float) number_format($positive_score / $sentiment_class_occurrence[self::POSITIVE], 2);
        }
        if (array_key_exists(self::NEGATIVE, $sentiment_class_occurrence)) {
            $this->negative_score = (float) number_format($negative_score / $sentiment_class_occurrence[self::NEGATIVE], 2);
        }
        if (array_key_exists(self::NEUTRAL, $sentiment_class_occurrence)) {
            $this->neutral_score = (float) number_format($neutral_score / $sentiment_class_occurrence[self::NEUTRAL], 2);
        }

        // Set Dominant Decision
        $dominant_decision = key($sentiment_class_occurrence);
        $this->dominant_decision = $dominant_decision;

        $dominant_score = $dominant_decision == 'positive' ? $this->positive_score : ($dominant_decision == 'negative' ? $this->negative_score : $this->neutral_score);
        $this->dominant_score = $dominant_score;

        $this->dominant_sentiment_color = $this->sentimentalityColor($dominant_decision);

        $this->dominant_sentiment_class = array(
            'decision' => key($sentiment_class_occurrence),
            'score' => $dominant_decision == 'positive' ? $this->positive_score : ($dominant_decision == 'negative' ? $this->negative_score : $this->neutral_score),
        );

        $this->result = array(
            'positive_score' => $this->positive_score,
            'negative_score' => $this->negative_score,
            'neutral_score' => $this->neutral_score,
            'dominant_decision' => $this->dominant_decision,
            'dominant_sentiment_color' => $this->dominant_sentiment_color,
            'dominant_score' => $this->dominant_score,
            'dominant_sentiment_class' => $this->dominant_sentiment_class,
            'sentiment_class_occurrence' => $this->sentiment_class_occurrence,
        );
    }

    private function collectProductReviewSentimentalities()
    {
        $reviews = $this->product->reviews;
        foreach ($reviews as $review) {
            $this->product_review_sentimentalities[] = $review->sentimentality;
        }
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
