@extends('main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-5">
        <div class="row d-flex justify-content-center py-4">
            <div class="col-md-8 d-flex flex-column">
                <h1 class="text-center display-5">Categories.</h1>
                <div class="row d-flex justify-content-center" style="height: 100px;">
                    <p class="text-uppercase text-center text-muted">
                        <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $id }}</span>
                    </p>
                </div>
                <div class="row d-flex justify-content-center border-top">
                    <a class="btn btn-primary shadow text-center btn-sm mx-5 text-uppercase mt-2" href="/" role="button">Back</a> 
                </div>        
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mb-5">
                <div class="wrapper shadow rounded pb-5" style="max-height:80vh; overflow:scroll;">
                        <ul class="list-group">
                            @foreach ($trades as $key => $value)
                            <a href="/{{ $id }}/{{ $value->DESC }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $value->DESC }}
                                <span class="badge badge-primary badge-pill">{{ $value->TOTAL }}</span>
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
                <h1>Summary</h1>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="categoryChart" width="350" height="350"></canvas>
                </div>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="importChart" width="350" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Imports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $key => $value)
                            <tr>
                                <th scope="row">{{ substr($value->DESC, 0, 10)}}</th>
                                <td>{{ $value->IMPORT }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row py-2">
                <div class="chart-wrapper shadow p-5">
                    <canvas id="exportChart" width="350" height="350"></canvas>
                </div>
                <div class="col mr-5">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Exports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $key => $value)
                            <tr>
                                <th scope="row">{{ substr($value->DESC, 0, 10)}}</th>
                                <td>{{ $value->EXPORT }}</td>
                            </tr>
                        @endforeach
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
var trades = @json($trades);
labels = [];
counts = [];
imports = [];
exports = [];

for (i in trades) {
    labels.push(trades[i]['DESC'].substr(0, 10));
    counts.push(trades[i]['TOTAL']);
    imports.push(trades[i]['IMPORT']);
    exports.push(trades[i]['EXPORT']);
}

var ctx = document.getElementById('categoryChart');
var categoryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Category Count',
            data: counts,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
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

var ctx = document.getElementById('importChart');
var importChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Import Count',
            data: imports,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
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

var ctx = document.getElementById('exportChart');
var exportChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Category Count',
            data: exports,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
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
</script>
@endsection