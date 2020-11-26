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
@endsection

@section('content')
<div class="row mb-5">
    <nav class="col-3 d-none d-block bg-light sidebar">
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
    <div class="col-9">
        <div class="row py-3">
            <h4 class="font-weight-bold text-uppercase" id="countryName"></h4>
        </div>
        <div class="row">
            <div class="card shadow rounded" style="width:16rem;">
                <div class="card-header card-header-text">
                    Total Exports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="totalExportNo" style="font-size: 2rem;"></div>
            </div>
            <span class="mx-2"></span>
            <div class="card shadow rounded" style="width:16rem;">
                <div class="card-header card-header-text">
                    Total Imports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="totalImportNo" style="font-size: 2rem;"></div>
            </div>
            <span class="mx-2"></span>
            <div class="card shadow rounded" style="width:16rem;">
                <div class="card-header card-header-text">
                    Max Imports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="maxImportYear" style="font-size: 2rem;">
                    
                </div>
            </div>
            <span class="mx-2"></span>
            <div class="card shadow rounded" style="width:16rem;">
                <div class="card-header card-header-text">
                    Max Exports <br>
                    <span class="card-header-span yearDuration"></span>
                </div>
                <div class="card-body card-body-text" id="maxExportYear" style="font-size: 2rem;">
                    
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-8 shadow">
                <canvas id="seriesChart" width="400" height="250"></canvas>
            </div>
            <div class="col-4 px-5 pt-2 pb-5 d-flex flex-column">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <span class="text-uppercase">Projected Imports</span>
                            <h1 class="text-muted">2020</h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="text-muted" style="font-size: 3rem;">46M</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <span class="text-uppercase">Projected Exports</span>
                            <h1 class="text-muted">2020</h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="text-muted" style="font-size: 3rem;">46M</span>
                    </div>
                </div>
                <div class="row">
                    <img src="./img/graph.png" alt="" style="width:60%; opacity:80%;">
                </div>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-between mx-2">
            <div class="col-6">
                <canvas id="exportByCategory" width="400" height="250"></canvas>
            </div>
            <div class="col-6">
                <canvas id="importByCategory" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script> 
    $(document).ready(function() {
        var country = 'SINGAPORE';
        renderCharts(country);

        $('.countryButton').click(function() {
            var country = $(this).data('country');
            removeData(window.seriesChart);
            removeData(window.exportByCategory);
            removeData(window.importByCategory);

            renderCharts(country);

        })
    })

    function removeData(chart) {
        var count = chart.config.data.datasets.length;

        while (count > 0)
        {
            chart.data.datasets.pop();
            count --;
        }
        chart.update();
    }

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

                $('#totalExportNo').text((total_export/1000000).toFixed(2) + 'M')
                $('#totalImportNo').text((total_import/1000000).toFixed(2) + 'M')
                $('#maxImportYear').text(max_import_year)
                $('#maxExportYear').text(max_export_year)
                $('.yearDuration').text(minYear + ' - ' + maxYear)
                $('#countryName').text(countryName);

                var ctx = document.getElementById('seriesChart');
                window.seriesChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: series_years,
                        datasets: [{ 
                            data: series_imports,
                            label: "Imports",
                            borderColor: "#EC7063",
                            fill: true
                        }, { 
                            data: series_exports,
                            label: "Exports",
                            borderColor: "#5DADE2",
                            fill: true
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
    }
</script>
@endsection