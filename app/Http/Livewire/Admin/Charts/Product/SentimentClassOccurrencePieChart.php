<?php

namespace App\Http\Livewire\Admin\Charts\Product;

use Livewire\Component;

class SentimentClassOccurrencePieChart extends Component
{
    public $positive_occurrence = 0;
    public $negative_occurrence = 0;
    public $neutral_occurrence = 0;

    public function mount($positive_occurrence, $negative_occurrence, $neutral_occurrence)
    {
        $this->positive_occurrence = $positive_occurrence;
        $this->negative_occurrence = $negative_occurrence;
        $this->neutral_occurrence = $neutral_occurrence;
    }

    public function render()
    {
        return view('livewire.admin.charts.product.sentiment-class-occurrence-pie-chart');
    }
}
