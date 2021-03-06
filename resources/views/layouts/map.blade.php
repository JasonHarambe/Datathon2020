@extends('main')

@section('head')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  $(document).ready(function() {
    var baseUrl = window.location.origin;

    $.ajax({
      url: baseUrl + '/getmapinfo',
      success: function (response) {
        var export_table = [['Country', 'Export']];
        var import_table = [['Country', 'Import']];

        $.each(response, function (index, response) {
          export_table.push([(response.country).substring(0,1).toUpperCase() + (response.country).substring(1).toLowerCase(), parseInt(response.export)]);
          import_table.push([(response.country).substring(0,1).toUpperCase() + (response.country).substring(1).toLowerCase(), parseInt(response.import)]);
        })
        
        google.charts.load('current', {
          'packages':['geochart'],
          'mapsApiKey': 'AIzaSyBPDtTrJV4B3e0Tnwx3__4RXOstRB-vnWU'
        });

        google.charts.setOnLoadCallback(function() {

          var export_data = google.visualization.arrayToDataTable(export_table);
          var import_data = google.visualization.arrayToDataTable(import_table);
          var options = {};

          var import_chart = new google.visualization.GeoChart(document.getElementById('ImportMap'));
          var export_chart = new google.visualization.GeoChart(document.getElementById('ExportMap'));

          export_chart.draw(export_data, options);
          import_chart.draw(import_data, options);
        });
      }
    })
  })
</script>
@endsection


@section('content')
<div class="row d-flex justify-content-center">
  <h1 class="mt-4 text-muted font-weight-bold">Total Exports Map <br><p style="font-size:1rem;" class="text-center">explore Malaysia's exports</p></h1>
</div>
<div class="row p-5">
  <div class = "col-1"></div>
  <div class="col-10 shadow" id="ExportMap" style="width:85%;"></div>
  <div class = "col-1"></div>
</div>
<div class="row d-flex justify-content-center">
  <h1 class="mt-4 text-muted font-weight-bold">Total Imports Map <br><p style="font-size:1rem;" class="text-center">explore Malaysia's imports</p></h1>
</div>
<div class="row p-5">
  <div class = "col-1"></div>
  <div class="col-10 shadow" id="ImportMap"></div>
  <div class = "col-1"></div>
</div>
@endsection