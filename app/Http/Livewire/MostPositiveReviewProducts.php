<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class MostPositiveReviewProducts extends Component
{
    public function render()
    {
        $sentimentality = Cache::get('sentimentality', []);
        $positive_reviews = array_column($sentimentality, 'positive_score', true);
        array_multisort($positive_reviews, SORT_DESC, $sentimentality);
        $top_ten_most_positive_review_products  = array_slice($sentimentality, 0, 10, true);
        $products = [];
        foreach ($top_ten_most_positive_review_products as $product => $sentiment) {
            $products[$product] = $sentiment->positive_score;
        }
        return view('livewire.most-positive-review-products', compact('products'));
    }
}
