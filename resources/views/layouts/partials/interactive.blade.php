@extends('main')

@section('head')
<script src="/js/utils.js"></script>
@endsection

@section('content')
<div class="row">
    <nav class="col-3 d-none d-block bg-light sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column mb-5 pb-3">
            <a class="disabled list-group-item list-group-item-action d-flex justify-content-between align-items-center"><h3>Countries</h3></a>
            @foreach ($countries as $country)
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center addDataset" data-country='{{ $country->country }}'>
                    {{ $country->country }}
                </a>
            @endforeach
            </ul>
        </div>
    </nav>
    <div class="col-9 d-flex flex-column">
        <div class="row py-4 chart-wrapper" style="width:100%;">
            <canvas id="canvas"></canvas>
        </div>
        <div class="row">
            <button id="removeDataset" class="btn btn-sm btn-primary shadow">Undo</button>
            <button id="clearAll" class="btn btn-sm btn-primary shadow ml-3">Clear All</button>  
            <div class="custom-control custom-switch ml-5">
                <input type="checkbox" class="custom-control-input" id="customSwitch" checked>
                <label class="custom-control-label" for="customSwitch" id="toggleWord">Import</label>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var exportOn = false;

    $(document).ready(function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    });

    $('#customSwitch').on('change', function () {
        exportOn = !exportOn;

        $('#toggleWord').text('Import' ? 'Export' : 'Import'); 

        removeData(window.myLine);
        updateConfigByMutating(window.myLine);
        
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
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
                        newDataset.data.push(imports[index]);
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