<div>
    <div class="card">
        <div class="card-body shadow-lg p-2">
            <div id="sentimentClassScoresBarChart" data-positive="{{$positive_score ?? 0}}"
                data-negative="{{$negative_score ?? 0}}" data-neutral="{{$neutral_score ?? 0}}"></div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
            
                $(document).ready(function(){
                    sentimentClassScoresBarChart();
                });
            
                                
                function sentimentClassScoresBarChart() {
                 $("#sentimentClassScoresBarChart").empty();
                 var positive =
                   parseFloat($("#sentimentClassScoresBarChart").data("positive")) * 100;
                 var negative =
                   parseFloat($("#sentimentClassScoresBarChart").data("negative")) * 100;
                 var neutral =
                   parseFloat($("#sentimentClassScoresBarChart").data("neutral")) * 100;
                 var sentimentClassScoresBarChartOption = {
                   chart: {
                     height: 350,
                     type: "bar",
                   },
                   plotOptions: {
                     bar: {
                       horizontal: false,
                       columnWidth: "55%",
                       endingShape: "rounded",
                       distributed: true
                     },
                     
                   },
                   dataLabels: {
                     enabled: false,
                   },
                   stroke: {
                     show: true,
                     width: 2,
                     colors: ["transparent"],
                   },
                   series: [
                     {
                       name: "Confidence Score",
                       data: [positive, negative, neutral],
                     },
                   ],
                   xaxis: {
                     categories: ["Positive", "Negative", "Neutral"],
                   },
                   yaxis: {
                     title: {
                       text: "Confidence Score",
                     },
                   },
                   fill: {
                     opacity: 1,
                   },
                   tooltip: {
                     y: {
                       formatter: function (val) {
                         return val + "%";
                       },
                     },
                   },
                   fill: {
                     colors:['#00ff00','#ff0000' , '#ffd700'],
                   },
                 };
               
                 // Initializing Column Basic Chart
                 var sentimentClassScoresBarChart = new ApexCharts(
                   document.querySelector("#sentimentClassScoresBarChart"),
                   sentimentClassScoresBarChartOption
                 );
                 sentimentClassScoresBarChart.render();
               }

                });
    </script>
    @endpush
</div>