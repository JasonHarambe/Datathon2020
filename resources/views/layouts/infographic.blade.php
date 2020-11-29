@extends('main')

@section('head')
<style>
.card-header-text {
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
}

.card-header-span {
    text-transform: normal;
    font-weight: normal;
}

.card-body-text {
    text-align: center;
    font-weight: bold;
    color: grey;
}
</style>
<script src="/js/utils.js"></script>
@endsection

@section('content')
<div class="row d-block d-sm-none">
    <nav class="navbar"> 
            <button class="navbar-toggler btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#navbarsecond" aria-controls="navbarsecond" aria-expanded="false" aria-label="Toggle navigation">
                Countries
            </button>
            <div class="collapse navbar-collapse" id="navbarsecond">
                <ul class="navbar-nav">
                <a class="disabled list-group-item list-group-item-action d-flex justify-content-between align-items-center"><h3 class="font-weight-bold text-muted">Countries</h3></a>
            
            @foreach ($countries as $country)
            <a href="#" data-country="{{ $country->country }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center countryButton">
                    {{ $country->country }}
                </a>
            @endforeach
                <ul>
            </div>         
    </nav>
</div>
<div class="row mb-5">
    <nav class="col-3 d-none d-md-block sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column mb-5 pb-3">
            @foreach ($countries as $country)
                <a href="#" data-country="{{ $country->country }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center countryButton">
                    {{ $country->country }}
                </a>
            @endforeach
            </ul>
        </div>
    </nav>
    <div class="col-xs-12 col-md-9 px-5">
        <div class="row pt-3 pb-1">
            <h1 class="font-weight-bold text-uppercase text-muted" id="countryName"></h1>
        </div>
        <div class="row">
            <div class="card shadow rounded mr-1" style="width:16rem;">
                <div class="card-header card-header-text bg-info text-light">
                    Total Exports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="totalExportNo" style="font-size: 2rem;"></div>
            </div>
            <div class="card shadow rounded mx-1" style="width:16rem;">
                <div class="card-header card-header-text bg-primary text-light">
                    Total Imports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="totalImportNo" style="font-size: 2rem;"></div>
            </div>
            <div class="card shadow rounded mx-1" style="width:16rem;">
                <div class="card-header card-header-text bg-success text-light">
                    Max Imports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="maxImportYear" style="font-size: 2rem;">                  
                </div>
            </div>
            <div class="card shadow rounded" style="width:16rem;">
                <div class="card-header card-header-text bg-secondary text-light">
                    Max Exports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="maxExportYear" style="font-size: 2rem;">
                    
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <h1 class='col-12 text-muted font-weight-bold my-4'>Imports & Exports Over the Years</h1>
            <div class="col-xs-12 col-md-8 shadow p-5">
                <canvas id="seriesChart" width="400" height="250"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 px-5 pt-2 pb-5 d-flex flex-column">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <span class="text-uppercase font-weight-bold">Projected Imports</span>
                            <h1 class="text-muted projectedYear"></h1>
                        </div>
                    </div>
                    <div class="col-8">
                        <span class="card-body-text" style="font-size: 2rem;" id="projectedImport"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <span class="text-uppercase font-weight-bold">Projected Exports</span>
                            <h1 class="text-muted projectedYear"></h1>
                        </div>
                    </div>
                    <div class="col-8">
                        <span class="card-body-text" style="font-size: 2rem;" id="projectedExport"></span>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <img src="./img/graph.png" alt="" style="width:60%; opacity:80%;">
                </div>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-between mx-2">
            <div class="col-xs-12 col-md-6">
                <canvas id="exportByCategory" width="60%" height="60%"></canvas>
            </div>
            <div class="col-xs-12 col-md-6">
                <canvas id="importByCategory" width="60%" height="60%"></canvas>
            </div>
        </div>
        <div class="row mt-5 d-none d-md-flex justify-content-center">
            <h1 class="text-muted font-weight-bold col-12 my-4 text-center">Imports Per Year By Category</h1>
        </div>
        <div class="row mt-2 d-none d-md-flex ">
            <div class="container" style="width:85%;">
                <canvas id="importBubbleChart" width="400" height="250"></canvas>
            </div>
        </div>
        <div class="row mt-4 d-none d-md-flex  justify-content-center">
        <h1 class="text-muted font-weight-bold col-12 my-4 text-center">Exports Per Year By Category</h1>
        </div>
        <div class="row mt-2 d-none d-md-flex ">
            <div class="container" style="width:85%;">
                <canvas id="exportBubbleChart" width="400" height="250"></canvas>
            </div>
        </div>
        <div class="row mt-4 d-flex justify-content-center">
            <h1 class="text-muted font-weight-bold col-12 my-4 text-center">Net Exports</h1>
        </div>
        <div class="row mt-2">
            <div class="container" style="width:85%;">
                <div class="wrapper"><canvas id="netExportChart"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script> 

    var utils = Samples.utils;

    $(document).ready(function() {
        var country = 'SINGAPORE';
        renderCharts(country);

        $('.countryButton').click(function() {
            var country = $(this).data('country');
            removeData(window.seriesChart);
            removeData(window.exportByCategory);
            removeData(window.importByCategory);
            removeData(window.importBubbleChart);
            removeData(window.exportBubbleChart);
            removeData(window.netExportChart);

            renderCharts(country);

        });	

    })

    function colorize(opaque, ctx) {
        var v = ctx.dataset.data[ctx.dataIndex];

        var c = v < -50 ? '#D60000'
            : v < 0 ? '#F46300'
            : v < 50 ? '#0358B6'
            : '#44DE28';

        return opaque ? c : utils.transparentize(c, 1 - Math.abs(v / 150));
    }

    function removeData(chart) {
        var count = chart.config.data.datasets.length;

        while (count > 0)
        {
            chart.data.datasets.pop();
            count --;
        }
        chart.update();
    }

    const formatNum = n => {
        if (n < 1e3) return n;
        if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(1) + "K";
        if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(1) + "M";
        if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(1) + "B";
        if (n >= 1e12) return +(n / 1e12).toFixed(1) + "T";
    };

    function renderCharts(country) {
        var baseUrl = window.location.origin;

        $.ajax({
            url: baseUrl + '/getchartdata/' + country,
            success: function (response) {
                var total_export = 0;
                var total_import = 0;  
                var max_import_year;
                var max_export_year;  
                var max_export = 0;
                var max_import = 0;
                var series_years = [];
                var series_exports = [];
                var series_imports = [];

                $.each(response, function (index, response) {
                    total_export += parseInt(response.export);
                    total_import += parseInt(response.import);
                    if (parseInt(response.export) > max_export) {
                        max_export = parseInt(response.export);
                        max_export_year = response.year;
                    }
                    if (parseInt(response.import) > max_import) {
                        max_import = parseInt(response.import);
                        max_import_year = response.year;
                    }
                    series_years.push(response.year);
                    series_exports.push((response.export / 1000000));
                    series_imports.push((response.import / 1000000));
                });

                var minYear = response[0].year;
                var maxYear = response[response.length - 1].year;
                var countryName = response[0].country;

                var net_exports = series_exports.map(function(item, index) {
                    return (item - series_imports[index]).toFixed(1);
                })

                $('#totalExportNo').text(formatNum(total_export))
                $('#totalImportNo').text(formatNum(total_import))
                $('#maxImportYear').text(max_import_year)
                $('#maxExportYear').text(max_export_year)
                $('.yearDuration').text(minYear + ' - ' + maxYear)
                $('#countryName').text(countryName);
                $('.projectedYear').text(maxYear + 1);
                $('#projectedExport').text(formatNum(total_export / (maxYear - minYear)));
                $('#projectedImport').text(formatNum(total_import / (maxYear - minYear)));

                var ctx = document.getElementById('seriesChart');
                window.seriesChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: series_years,
                        datasets: [{ 
                            data: series_imports,
                            label: "Imports",
                            borderColor: "#EC7063",
                            fill: false
                        }, { 
                            data: series_exports,
                            label: "Exports",
                            borderColor: "#5DADE2",
                            fill: false
                        }
                        ]
                    },
                    options: {
                        title: {
                        display: true,
                        text: 'Import Exports Over The Years (M)'
                        }
                    }
                });

                var net_data = {
                    labels: series_years,
                    datasets: [{
                        data: net_exports
                    }]
                };

                var net_options = {
                    plugins: {
                        legend: false,
                        tooltip: false,
                    },
                    elements: {
                        rectangle: {
                            backgroundColor: colorize.bind(null, false),
                            borderColor: colorize.bind(null, true),
                            borderWidth: 2
                        }
                    }
                };

                window.netExportChart = new Chart('netExportChart', {
                    type: 'bar',
                    data: net_data,
                    options: net_options
                });
            }
        })  
        
        $.ajax({
            url: baseUrl + '/groupbycategory/' + country,
            success: function(response) {
                var description = [];
                var desc_exports = [];
                var desc_imports = [];

                $.each(response, function(index, response) {
                    description.push(response.desc.split(' ')[0]);
                    desc_exports.push((response.export / 1000000));
                    desc_imports.push(response.import / 1000000);
                })

                var ctx = document.getElementById('exportByCategory').getContext('2d');
                window.exportByCategory = new Chart(ctx, {
                    type: 'doughnut',
                        data: {
                            labels: description,
                            datasets: [{
                                label: "Exports (M)",
                                backgroundColor: ["#DFFF00", "#FFBF00","#FF7F50","#DE3163","#9FE2BF", '#40E0D0', '#6495ED','#CCCCFF', '#2874A6','#145A32'],
                                data: desc_exports
                                }]
                        },
                    options: {
                        title: {
                            display: true,
                            text: 'Total Exports By Category (M)'
                        }
                    }
                });

                var ctx = document.getElementById('importByCategory').getContext('2d');
                window.importByCategory = new Chart(ctx, {
                    type: 'doughnut',
                        data: {
                            labels: description,
                            datasets: [{
                                label: "Imports (M)",
                                backgroundColor: ["#DFFF00", "#FFBF00","#FF7F50","#DE3163","#9FE2BF", '#40E0D0', '#6495ED','#CCCCFF', '#2874A6','#145A32'],
                                data: desc_imports
                                }]
                        },
                    options: {
                        title: {
                            display: true,
                            text: 'Total Imports By Category (M)'
                        }
                    }
                });
            }
        })

        $.ajax({
            url: baseUrl + '/getbubblechartdata/' + country,
            success: function(response) {
                var import_datasets = [];
                var export_datasets = [];
                var import_data = [];
                var export_data = [];
                
                var colorNames = Object.keys(window.chartColors);
                var color = Chart.helpers.color;

                var max = response[1];
                var desc = response[0][0].desc;
                var count = 0;
                var colorNum = 0;

                $.each(response[0], function(index, arg) {
                    if (arg.desc == desc) {

                        import_data.push({
                            x: arg.year,
                            y: arg.import,
                            r: (arg.import / max[count].import) * 100
                        })

                        export_data.push({
                            x: arg.year,
                            y: arg.export,
                            r: (arg.export / max[count].export) * 100
                        })

                        count += 1;

                    } else {    

                        var colorName = colorNames[colorNum % colorNames.length];
                        var dsColor = window.chartColors[colorName];   
                                         
                        import_datasets.push({
                            label: arg.desc,
                            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                            borderColor: dsColor,
                            borderWidth: 1,
                            data: import_data
                        });

                        export_datasets.push({
                            label: arg.desc,
                            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                            borderColor: dsColor,
                            borderWidth: 1,
                            data: export_data
                        });

                        colorNum += 1;

                        desc = arg.desc;
                        import_data = [];
                        export_data = [];

                        import_data.push({
                            x: arg.year,
                            y: arg.import,
                            r: (arg.import / max[0].import) * 100
                        })
                        export_data.push({
                            x: arg.year,
                            y: arg.export, 
                            r: (arg.export / max[0].export) * 100
                        })

                        count = 1;
                    }
                })

                var importBubbleChartData = {
                    datasets: import_datasets
                };

                var exportBubbleChartData = {
                    datasets: export_datasets
                };

                var ctx = document.getElementById('importBubbleChart').getContext('2d');
                window.importBubbleChart = new Chart(ctx, {
                    type: 'bubble',
                    data: importBubbleChartData,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: false,
                                text: ''
                            },
                            tooltip: {
                                mode: 'point'
                            }
                        }
                    }
                });

                var ctx = document.getElementById('exportBubbleChart').getContext('2d');
                window.exportBubbleChart = new Chart(ctx, {
                    type: 'bubble',
                    data: exportBubbleChartData,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: false,
                                text: ''
                            },
                            tooltip: {
                                mode: 'point'
                            }
                        }
                    }
                });
            }
        })

    }
</script>
@endsection