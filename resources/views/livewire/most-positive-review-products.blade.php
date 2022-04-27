<div>
    <div class="card">
        <div class="card-body shadow-lg p-2">
            <div id="mostPositiveReviewProductsBarChart" data-products="{{json_encode($products)}}"></div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
            
                $(document).ready(function(){
                    mostPositiveReviewProductsBarChart();
                });
            
                                
                function mostPositiveReviewProductsBarChart() {
                 $("#mostPositiveReviewProductsBarChart").empty();
                 var products = JSON.parse($("#mostPositiveReviewProductsBarChart").attr('data-products'));
                 var mostPositiveReviewProductsBarChartOption = {
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
                       data: Object.values(products),
                     },
                   ],
                   xaxis: {
                     categories: Object.keys(products),
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
                     colors:['#00ff00','#ff0000' , '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd700', '#0000ff', '#ff00ff', '#00ffff', '#ffff00', '#000000', '#ffffff', '#ffa500', '#ff00ff', '#00ff00', '#ff0000', '#ffd'],
                   },
                 };
               
                 // Initializing Column Basic Chart
                 var mostPositiveReviewProductsBarChart = new ApexCharts(
                   document.querySelector("#mostPositiveReviewProductsBarChart"),
                   mostPositiveReviewProductsBarChartOption
                 );
                 mostPositiveReviewProductsBarChart.render();
               }

                });
    </script>
    @endpush
</div>