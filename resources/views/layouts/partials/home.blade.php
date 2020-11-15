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
                    <ul class="list-group">
                        @foreach ($countries as $key => $value)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $key }}
                            <span class="badge badge-primary badge-pill">{{ $value }}</span>
                        </li>
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
                    <canvas id="importChart" width="350" height="350"></canvas>
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

    // var net = document.getElementById('netChart');

    // var netChart = new Chart(net, {
    //     type: 'doughnut',
    //     data: {
    //         datasets: [{
    //             data: [imports[0], exports[0]],
    //             backgroundColor: [
    //             'rgba(255, 99, 132, 0.2)',
    //             'rgba(54, 162, 235, 0.2)'
    //         ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)'
    //             ],
    //             borderWidth: 1
    //         }],

    //         // These labels appear in the legend and in the tooltips when hovering different arcs
    //             labels: [
    //                 'Import',
    //                 'Export',
    //         ]
    //     }
    // });
</script>
@endsection