<?php

namespace App\Http\Livewire\Admin\Charts\Product;

use Livewire\Component;

class SentimentClassScoresBarChart extends Component
{
    public $positive_score = 0;
    public $negative_score = 0;
    public $neutral_score = 0;

    public function mount($positive_score, $negative_score, $neutral_score)
    {
        $this->positive_score = $positive_score;
        $this->negative_score = $negative_score;
        $this->neutral_score = $neutral_score;
    }

    public function render()
    {
        return view('livewire.admin.charts.product.sentiment-class-scores-bar-chart');
    }
}
