@extends('main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
@endsection

@section('content')
<div class="row">
    <nav class="col-3 d-none d-block bg-light sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column pb-3 mb-5">
                <div class="row d-flex py-3 flex-column mx-3">
                    <h3 class="text-center">Category</h3>
                    <div class="row d-flex justify-content-center mt-2">
                        <a href="/" class="btn btn-primary btn-sm text-uppercase" role='button'>home</a>
                        <span class="mx-1"></span>
                        <a href="/{{ $id }}/{{ $first }}/{{ $second }}/{{ $third }}/{{ $fourth }}" class="btn btn-success btn-sm text-uppercase" role='button'>back</a>
                    </div>
                </div>
                <ul class="list-group">
                    @if (!empty($trades) > 0)
                        <li class="list-group-item">Database ID: <strong><span class='h5'>{{ $trades[0]->id }}</span></strong> </li>
                        <li class="list-group-item">Category 1: <strong><span class="h5">{{ $trades[0]->sitc1 }}</span></strong> <br> {{ $first }}</li>
                        <li class="list-group-item">Category 2: <strong><span class="h5">{{ $trades[0]->sitc2 }}</span></strong> <br> {{ $second }}</li>
                        <li class="list-group-item">Category 3: <strong><span class="h5">{{ $trades[0]->sitc3 }}</span></strong> <br> {{ $third }} </li>
                        <li class="list-group-item">Category 4: <strong><span class="h5">{{ $trades[0]->sitc4 }}</span></strong> <br> {{ $fourth }}</li>
                        <li class="list-group-item">Category 5: <strong><span class="h5">{{ $trades[0]->sitc5 }}</span></strong> <br> {{ $fifth }}</li>
                        <li class="list-group-item">Country: <strong><span class="h5">{{ $trades[0]->country }}</span></strong></li>
                    @endif
                </ul> 
            </ul>
        </div>
    </nav>
    <div class="col-9">
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
                                <th scope="col">Import (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trades as $trade)
                                <tr>
                                    <th scope="row">{{ $trade->year }}</th>
                                    <td>{{ $trade->import }}</td>
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
                                <th scope="col">Year</th>
                                <th scope="col">Export (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trades as $trade)
                                <tr>
                                    <th scope="row">{{ $trade->year }}</th>
                                    <td>{{ $trade->export }}</td>
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

    var ctx = document.getElementById('importChart');

    var years = @json($years);
    var imports = @json($imports);
    var exports = @json($exports);

    var importChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Imports Over Years',
                data: imports,
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
            labels: years,
            datasets: [{
                label: 'Exports Over Years',
                data: exports,
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