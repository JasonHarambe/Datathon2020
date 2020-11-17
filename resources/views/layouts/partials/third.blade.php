@extends('main')

@section('content')
<div class="row">
    <div class="col-5">
        <div class="row d-flex justify-content-center py-4">
            <div class="col-md-8 d-flex flex-column">
                <h1 class="text-center display-5">Categories...</h1>
                <div class="row d-flex justify-content-center" style="height: 100px;">
                    <p class="text-uppercase text-center text-muted">
                        <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $id }}</span>
                        <span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </span>
                        <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $first }}</span>
                        <span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </span>
                        <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $second }}</span>
                    </p>
                </div>
                <div class="row d-flex justify-content-center border-top">
                    <a class="btn btn-primary shadow text-center btn-sm mx-5 text-uppercase mt-2" href="/{{ $id }}/{{ $first }}" role="button">Back</a> 
                    <a class="btn btn-success shadow text-center btn-sm mx-5 text-uppercase mt-2" href="/" role="button">Home</a> 
                </div>  
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mb-5">
                <div class="wrapper shadow rounded pb-5" style="max-height:80vh; overflow:scroll;">
                    <ul class="list-group">
                        @foreach ($trades as $key => $value)
                        <a href="/{{ $id }}/{{ $first }}/{{ $second }}/{{ $value->DESC }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $value->DESC }}
                            <span class="badge badge-primary badge-pill">{{ $value->TOTAL }}</span>
                        </a>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-7">
        @include('layouts.partials.page_graph')
    </div>
</div>
@endsection

@section('script')
    @include('layouts.partials.chart')
@endsection