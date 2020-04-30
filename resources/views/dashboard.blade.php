<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CurrencyFair</title>

        <script src="/js/amcharts4/core.js"></script>
        <script src="/js/amcharts4/charts.js"></script>
        <script src="/js/amcharts4/themes/animated.js"></script>
        <script>
            am4core.ready(function() {
                am4core.useTheme(am4themes_animated);

                var currencyFromChart = am4core.create("currencyFromChart", am4charts.PieChart);
                currencyFromChart.data = {!! json_encode($statistics["currencyFrom"]) !!};
                currencyFromChart.innerRadius = am4core.percent(50);

                // Add and configure Series
                var currencyFromChartPieSeries = currencyFromChart.series.push(new am4charts.PieSeries());
                currencyFromChartPieSeries.dataFields.value = "count";
                currencyFromChartPieSeries.dataFields.category = "currency";
                currencyFromChartPieSeries.slices.template.stroke = am4core.color("#fff");
                currencyFromChartPieSeries.slices.template.strokeWidth = 2;
                currencyFromChartPieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                currencyFromChartPieSeries.hiddenState.properties.opacity = 1;
                currencyFromChartPieSeries.hiddenState.properties.endAngle = -90;
                currencyFromChartPieSeries.hiddenState.properties.startAngle = -90;


                var currencyToChart = am4core.create("currencyToChart", am4charts.PieChart);
                currencyToChart.data = {!! json_encode($statistics["currencyTo"]) !!};
                currencyToChart.innerRadius = am4core.percent(50);

                // Add and configure Series
                var currencyToChartPieSeries = currencyToChart.series.push(new am4charts.PieSeries());
                currencyToChartPieSeries.dataFields.value = "count";
                currencyToChartPieSeries.dataFields.category = "currency";
                currencyToChartPieSeries.slices.template.stroke = am4core.color("#fff");
                currencyToChartPieSeries.slices.template.strokeWidth = 2;
                currencyToChartPieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                currencyToChartPieSeries.hiddenState.properties.opacity = 1;
                currencyToChartPieSeries.hiddenState.properties.endAngle = -90;
                currencyToChartPieSeries.hiddenState.properties.startAngle = -90;


                var originatingCountryChart = am4core.create("originatingCountryChart", am4charts.PieChart);
                originatingCountryChart.data = {!! json_encode($statistics["originatingCountry"]) !!};
                originatingCountryChart.innerRadius = am4core.percent(50);

                // Add and configure Series
                var originatingCountryChartPieSeries = originatingCountryChart.series.push(new am4charts.PieSeries());
                originatingCountryChartPieSeries.dataFields.value = "count";
                originatingCountryChartPieSeries.dataFields.category = "country";
                originatingCountryChartPieSeries.slices.template.stroke = am4core.color("#fff");
                originatingCountryChartPieSeries.slices.template.strokeWidth = 2;
                originatingCountryChartPieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                originatingCountryChartPieSeries.hiddenState.properties.opacity = 1;
                originatingCountryChartPieSeries.hiddenState.properties.endAngle = -90;
                originatingCountryChartPieSeries.hiddenState.properties.startAngle = -90;

            }); // end am4core.ready()
        </script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 10px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .section-title {
                font-size: 30px;
                margin-bottom: 20px;
            }

            .messages-table tr:first-child td {
                font-weight: bold;
                border-bottom:solid 1px #636b6f;
            }

            .messages-table td {
                text-align: center;
                padding: 5px 20px 5px 20px;
            }

            .chart-div {
                width: 450px;
                height: 200px;
            }

            .row {
                margin-bottom:50px;
                width:1350px;
            }
        </style>
    </head>
    <body>
        <div style="margin-bottom:20px;">
            <img src="images/cf-logo-new.png" width="180">
        </div>

        <div style="width:100%;" align="center">
            <div class="row">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                            <div class="section-title m-b-md">
                                Currency From
                            </div>
                            <div id="currencyFromChart" class="chart-div"></div>
                        </td>
                        <td>
                            <div class="section-title m-b-md">
                                Currency To
                            </div>
                            <div id="currencyToChart" class="chart-div"></div>
                        </td>
                        <td>
                            <div class="section-title m-b-md">
                                Originating Country
                            </div>
                            <div id="originatingCountryChart" class="chart-div"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <div class="section-title m-b-md" align="left">
                    Trade Messages
                </div>
                <table class="messages-table" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>User ID</td>
                        <td>Currency From</td>
                        <td>Currency To</td>
                        <td>Amount Sell</td>
                        <td>Amount Buy</td>
                        <td>Rate</td>
                        <td>Time Placed</td>
                        <td>Originating Country</td>
                    </tr>

                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->user_id }}</td>
                            <td>{{ $message->currency_from }}</td>
                            <td>{{ $message->currency_to }}</td>
                            <td>{{ "\$".number_format($message->amount_sell,2) }}</td>
                            <td>{{ "\$".number_format($message->amount_buy,2) }}</td>
                            <td>{{ $message->rate }}</td>
                            <td>{{ $message->time_placed }}</td>
                            <td>{{ $message->originating_country }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>

    </body>
</html>
