<div>
    <div class="card">
        <div class="card-body shadow-lg p-2">
            <div id="productSentimentClassOccurrence" data-positive={{$positive_occurrence ?? 0}}
                data-negative={{$negative_occurrence ?? 0}} data-neutral={{$neutral_occurrence ?? 0}}></div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
    
                        $(document).ready(function(){
                            productSentimentClassOccurrence();
                        });
    
                        
                         function productSentimentClassOccurrence()
                        {
                            $('#productSentimentClassOccurrence').empty();
                            var positive = $('#productSentimentClassOccurrence').data('positive');
                            var negative = $('#productSentimentClassOccurrence').data('negative');
                            var neutral = $('#productSentimentClassOccurrence').data('neutral');

                            var productSentimentClassOccurrenceOptions = {
                                 chart: {
                                     width: 380,
                                     type: 'pie',
                                 },
                                 labels: ['Positive', 'Negative', 'Neutral'],
                                 series: [positive, negative , neutral],
                                 responsive: [{
                                     breakpoint: 480,
                                     options: {
                                         chart: {
                                             width: 200
                                         },
                                         legend: {
                                             position: 'bottom'
                                         }
                                     }
                                 }],
                                 colors:['#00ff00','#ff0000' , '#ffd700'],
                             }
                
                             var productSentimentClassOccurrence = new ApexCharts(
                                 document.querySelector("#productSentimentClassOccurrence"),
                                 productSentimentClassOccurrenceOptions
                             );
                             
                             productSentimentClassOccurrence.render();
                        }
        });
    </script>
    @endpush
</div>