@extends('main')
@section('head')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyBPDtTrJV4B3e0Tnwx3__4RXOstRB-vnWU'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);


      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Import'],
          ['Antartica', 0],
          ['China', 800000],
          ['China', 735361],
          ['Japan', 348548],
          ['United States', 277289],
          ['Singapore', 272297],
          ['Thailand', 257643],
          ['Korea', 188505],
          ['Indonesia', 186801],
          ['Taiwan',152245],
          ['Germany',148483],
          ['Australia',95267]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyBPDtTrJV4B3e0Tnwx3__4RXOstRB-vnWU'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);


      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Export'],
          ['Antartica', 0],
          ['Singapore', 500000],
          ['Singapore', 459064],
          ['China', 374575],
          ['United States', 364648],
          ['Japan', 266305],
          ['Thailand', 241360],
          ['Indonesia', 166369],
          ['Hong Kong', 154222],
          ['Germany',146532],
          ['India',142191],
          ['Vietnam',131322]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div2'));

        chart.draw(data, options);
      }
    </script>
@endsection
@section('content')
<div class = "row">
<div class = "col-6">
<h3>Top 10 Countries by Import</h3>
</div>
<div class = "col-6">
<h3>Top 10 Countries by Export</h3>
</div>
</div>
<div class = "row">
<div class = "col-6" id="regions_div" style="width: 50%; height: 500px;"></div>
<div class = "col-6" id="regions_div2" style="width: 50%; height: 500px;"></div>
</div>
<div class = "row">
<div class="col mx-5">
                    <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Country</th>
                            <th scope="col">Imports (M)</th>
                        </tr>
                    </thead class="thead-dark">
                    <tbody>
                        @foreach ($eleven as $country)
                        <tr>
                            <th scope="row">{{ $country->COUNTRY }}</th>
                            <td>{{ $country->IMPORT }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="col mx-5">
                    <table class="table table-bordered">
                    <thead class = "thead-dark">
                        <tr>
                            <th scope="col">Country</th>
                            <th scope="col">Exports (M)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ten as $country)
                        <tr>
                            <th scope="row">{{ $country->COUNTRY }}</th>
                            <td>{{ $country->EXPORT }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
@endsection
@section('script')

@endsection