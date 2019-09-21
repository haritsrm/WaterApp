@extends('layouts.app')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="chart-container">
                <div class="chart has-fixed-height" id="stacked_lines"></div>
            </div>
        </div>

        <script type="text/javascript">
            var echarts = require('echarts');
            // based on prepared DOM, initialize echarts instance
            var myChart = echarts.init(document.getElementById('stacked_lines'));

            // specify chart configuration item and data
            var option = {
                title: {
                    text: 'ECharts entry example'
                },
                tooltip: {},
                legend: {
                    data:['Sales']
                },
                xAxis: {
                    data: ["shirt","cardign","chiffon shirt","pants","heels","socks"]
                },
                yAxis: {},
                series: [{
                    name: 'Sales',
                    type: 'bar',
                    data: [5, 20, 36, 10, 10, 20]
                }]
            };

            // use configuration item and data specified to show chart
            myChart.setOption(option);
        </script>
    </div>

@endsection
