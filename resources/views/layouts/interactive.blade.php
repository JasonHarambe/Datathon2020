@extends('main')

@section('head')
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
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center addDataset" data-country='{{ $country->country }}'>
                    {{ $country->country }}
                    </a>
                @endforeach
                <ul>
            </div>         
    </nav>
</div>
<div class="row">
    <nav class="col-3 d-none d-md-block sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column mb-5 pb-3">
            <a class="disabled list-group-item list-group-item-action d-flex justify-content-between align-items-center"><h3 class="font-weight-bold">Countries</h3></a>
            @foreach ($countries as $country)
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center addDataset" data-country='{{ $country->country }}'>
                    {{ $country->country }}
                </a>
            @endforeach
            </ul>
        </div>
    </nav>
    <div class="col-xs-12 col-md-9 d-flex flex-column">
        <h1 class="col-12 text-muted font-weight-bold mt-4 mb-1">Interactive Viewer <span style="font-size:1rem;">(use Chrome)</span><br><p style="font-size:1rem;">click on any countries on the left and compare their exports or imports between countries</p></h1>
        <div class="row py-4 chart-container p-5" style="width:100%;">
            <canvas id="canvas"></canvas>
        </div>
        <div class="row ml-5">
            <button id="removeDataset" class="btn btn-sm btn-primary shadow my-2">Undo</button>
            <button id="clearAll" class="btn btn-sm btn-primary shadow ml-3 my-2">Clear All</button>  
            <div class="custom-control custom-switch ml-5">
                <input type="checkbox" class="custom-control-input" id="customSwitch" checked>
                <label class="custom-control-label" for="customSwitch" id="toggleWord"></label>
            </div>
            <p class="ml-2 text-muted font-weight-bold">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
                toggle between import and export</p>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var exportOn = false;
    $('#toggleWord').text('Import');

    $(document).ready(function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    });

    $('#customSwitch').on('change', function () {
        exportOn = !exportOn;

        removeData(window.myLine);
        updateConfigByMutating(window.myLine);
        window.myLine.update();
        
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);

        exportOn == true ? $('#toggleWord').text('Export') : $('#toggleWord').text('Import') 
    });

    var config = {
        type: 'line',
        data: {
            labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019'],
            datasets: []
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Imports Over Years'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }
            }
        }
    };

    function removeData(chart) {
        var count = config.data.datasets.length;

        while (count > 0)
        {
            config.data.datasets.pop();
            count --;
        }
        chart.update();
    }

    function updateConfigByMutating(chart) {
        config.options.title.text = exportOn == true ? 'Exports Over Years' : 'Imports Over Years';
        chart.update();
    }

    var colorNames = Object.keys(window.chartColors);

    $(document).ready(function() { 
        var baseUrl = window.location.origin;

        $(".addDataset").click(function() {
            var country = $(this).data('country');
            
            $.ajax({
                url: baseUrl + '/getchartdata/' + country,
                success: function (response) {
                    var years = [];
                    var imports = [];
                    var exports = [];
                    var country;

                    $.each(response, function (index, response) {
                        years.push(response.year);
                        imports.push(response.import);
                        exports.push(response.export);                    
                    });
                    countryName = response[0].country;

                    
                    var colorName = colorNames[config.data.datasets.length % colorNames.length];
                    var newColor = window.chartColors[colorName];

                    
                    var newDataset = {
                        label: countryName,
                        backgroundColor: newColor,
                        borderColor: newColor,
                        data: [],
                        fill: false
                    };

                    for (var index = 0; index < imports.length; ++index) {
                        if (exportOn == true)
                        {
                            newDataset.data.push(exports[index]);
                        }
                        else { newDataset.data.push(imports[index]); }
                    }

                    config.data.datasets.push(newDataset);

                    window.myLine.update();
                }
            });

        }); 
    });
    

    document.getElementById('removeDataset').addEventListener('click', function() {
        config.data.datasets.pop();
        window.myLine.update();
    });

    document.getElementById('clearAll').addEventListener('click', function() {
        removeData(window.myLine);
    });

</script>
@endsection