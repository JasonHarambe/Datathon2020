@extends('main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
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
                    <div class="list-group">
                        @foreach ( $results as $result)
                            <a href="/{{$result}}" class="list-group-item list-group-item-action">{{ $result }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="row d-flex flex-column py-4">
            <div class="row">
                <h1>Chart.js</h1>
            </div>
            <div class="row">
                <div class="chart-wrapper">
                    <canvas id="importChart" width="300" height="300"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="anotherChart" width="300" height="300"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="chart-wrapper">
                    <canvas id="countriesChart" width="350" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var ctx = document.getElementById('importChart');
    var years = @json($years);
    var imports = @json($imports);
    var exports = @json($exports);

    var importChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: years,
        datasets: [{
            label: 'Total Imports',
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

    var ctx = document.getElementById('anotherChart');

    var anotherChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: years,
        datasets: [{
            label: 'Total Imports',
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
</script>
@endsection