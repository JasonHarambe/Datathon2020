<div class="row d-flex flex-column py-4">
    <div class="row py-2 d-flex justify-content-between mr-5">
        <h1 class="text-muted font-weight-bold">Summary <br><p style="font-size:1rem;">number of count in each category</p></h1>
    </div>
    <div class="row py-2">
        <div class="chart-wrapper shadow p-5">
            <canvas id="categoryChart" width="775" height="350"></canvas>
        </div>
    </div>
    @if (!empty($series))
        @include('layouts.subs.series')
    @endif
    <div class="row py-2">
        <h1 class="text-muted font-weight-bold my-4 col-12">Total Imports By Category</h1>
        <div class="chart-wrapper shadow p-5">
            <canvas id="importChart" width="350" height="350"></canvas>
        </div>
        <div class="col mr-5">
            <table class="table table-bordered">
                <thead class = "thead-dark">
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Imports</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trades as $key => $value)
                        <tr>
                            <th scope="row">{{ substr($value->desc, 0, 10)}}</th>
                            <td>{{ $value->import }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row py-2">
        <h1 class="text-muted font-weight-bold my-4 col-12">Total Exports By Category</h1>
        <div class="chart-wrapper shadow p-5">
            <canvas id="exportChart" width="350" height="350"></canvas>
        </div>
        <div class="col mr-5">
            <table class="table table-bordered">
                <thead class = "thead-dark">
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Exports</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trades as $key => $value)
                        <tr>
                            <th scope="row">{{ substr($value->desc, 0, 10)}}</th>
                            <td>{{ $value->export }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
