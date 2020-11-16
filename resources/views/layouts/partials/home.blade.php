@extends('main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-5">
        <div class="row d-flex justify-content-center py-4">
            <div class="col-md-8">
                <h1 class="text-center display-5">Countries</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mb-5">
                <div class="wrapper shadow rounded pb-5" style="height:80vh; overflow:scroll;">
                    <ul class="list-group">
                        @foreach ($countries as $key => $value)
                        <a href="/{{ $key }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $key }}
                            <span class="badge badge-primary badge-pill">
                                {{ $value }}
                            </span>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="row d-flex flex-column py-4">
            <div class="row py-2 d-flex justify-content-between mr-5">
                <h1>Import / Export</h1>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="importChart" width="350" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Year</th>
                            <th scope="col">Import (M)</th>
                            <th scope="col">Export (M)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overall as $key => $value)
                        <tr>
                            <th scope="row">{{ $value['YEAR'] }}</th>
                            <td>{{ $value['IMPORT'] }}</td>
                            <td>{{ $value['EXPORT'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="maxChart" width="350" height="350"></canvas>
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

    var ctx = document.getElementById('maxChart');

    var maxChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['MY', 'AU', 'UK', 'USA' , 'China'],
            datasets: [{
                data: [60, 64, 100, 90, 84]
            }]
        },
        options: {
            scale: {
                angleLines: {
                    display: false
                },
                ticks: {
                    suggestedMin: 50,
                    suggestedMax: 100
                }
            }
        },
    });
</script>
@endsection