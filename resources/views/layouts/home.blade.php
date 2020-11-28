@extends('main')

@section('content')
<div class="row">
    <nav class="col-3 d-none d-block bg-light sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column mb-5 pb-3">
            <a class="disabled list-group-item list-group-item-action d-flex justify-content-between align-items-center"><h3 class="font-weight-bold text-muted">Countries</h3></a>
            @foreach ($countries as $key => $value)
                <a href="/master/{{ $key }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    {{ $key }}
                    <span class="badge badge-primary badge-pill">
                        {{ $value }}
                    </span>
                </a>
            @endforeach
            </ul>
        </div>
    </nav>
    <div class="col-9">
        <div class="row d-flex flex-column py-4">
            <div class="row py-2 d-flex justify-content-between mr-5">
                <h1 class="font-weight-bold text-muted col-12">Overall Imports and Exports <br><p style="font-size: 1rem;" class="ml-1">sum of all import and export from all countries</p></h1>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="importChart" width="550" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Year</th>
                            <th scope="col">Import (M)</th>
                            <th scope="col">Export (M)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overall as $key => $value)
                        <tr>
                            <th scope="row">{{ $value['year'] }}</th>
                            <td>{{ $value['import'] }}</td>
                            <td>{{ $value['export'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row py-2">
                <h1 class="text-muted font-weight-bold my-4 col-12">Top Ten Countries by Exports</h1>
                <div class="chart-wrapper shadow p-5">
                    <canvas id="maxExportChart" width="550" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Country</th>
                            <th scope="col">Exports (M)</th>
                        </tr>
                    </thead>
                    <tbody id="exportsTable">
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row py-2">
                <h1 class="text-muted font-weight-bold my-4 col-12">Top Ten Countries by Imports</h1>
                <div class="chart-wrapper shadow p-5">
                    <canvas id="maxImportChart" width="550" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Country</th>
                            <th scope="col">Imports (M)</th>
                        </tr>
                    </thead>
                    <tbody id="importsTable">
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function nFormatter(num) {
        // million formatter
        return ( num / 1000000).toFixed(1);
    }

    var ctx = document.getElementById('importChart');

    var years = @json($years);
    var imports = @json($imports);
    var exports = @json($exports);

    var importChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
                    label: 'Total Imports',
                    data: imports.map(nFormatter),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1,
                }, {
                    label: 'Total Exports',
                    data: exports.map(nFormatter),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 1,
                    type: 'line'
                }],
            labels: years
            },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    $(document).ready(function () {
        var baseUrl = window.location.href;

        $.ajax({
            url: baseUrl + 'gettoptenbyexports',
            success: function (response) {
                var ctx = document.getElementById('maxExportChart').getContext('2d');
                var exports_countries_list = [];
                var exports_list = [];

                response.forEach((element) => {
                    exports_countries_list.push(element.country);
                    exports_list.push(element.export);
                    $('#exportsTable').append("<tr><th scope='row'>" + element.country + "</th><td>" + element.export + "</td></tr>");
                })

                var maxExportChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        datasets: [{
                                label: 'Top 10 Countries by Export',
                                data: exports_list,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1,
                            }],
                        labels: exports_countries_list,
                        },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });

        $.ajax({
            url: baseUrl + 'gettoptenbyimports',
            success: function (response) {
                var ctx = document.getElementById('maxImportChart');
                var imports_countries_list = [];
                var imports_list = [];

                response.forEach((element) => {
                    imports_countries_list.push(element.country);
                    imports_list.push(element.import);
                    $('#importsTable').append("<tr><th scope='row'>" + element.country + "</th><td>" + element.import + "</td></tr>");
                })

                var maxImportChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        datasets: [{
                                label: 'Top 10 Countries by Imports',
                                data: imports_list,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1,
                            }],
                        labels: imports_countries_list,
                        },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
