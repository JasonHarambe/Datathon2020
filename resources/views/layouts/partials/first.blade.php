@extends('main')

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
    <div class="col-7 bg-dark"></div>
</div>
@endsection