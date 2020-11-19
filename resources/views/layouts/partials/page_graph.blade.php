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
                            <th scope="row">{{ substr($value->desc, 0, 10)}}</th>
                            <td>{{ $value->import }}</td>
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
                            <th scope="row">{{ substr($value->desc, 0, 10)}}</th>
                            <td>{{ $value->export }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>