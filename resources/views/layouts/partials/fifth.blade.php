@extends('main')

@section('content')
<div class="row d-flex justify-content-center py-4">
    <div class="col-md-6">
        <div class="row d-flex flex-column">
            <h1 class="text-center display-3">Fifth Category</h1>
            <div class="row d-flex flex-column mt-2">
                <p class="text-uppercase text-center text-muted">
                    <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $first }}</span>
                    <span>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </span>
                    <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $second }}</span>
                    <span>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </span>
                    <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $third }}</span>
                    <span>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </span>
                    <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $fourth }}</span>
                </p>
            </div>
            <div class="row d-flex justify-content-center">
                <a href="/{{$id}}/{{$first}}/{{$second}}/{{$third}}" class="text-uppercase text-dark font-weight-bold">BACK</a>
                <a href="/" class="text-uppercase text-dark font-weight-bold ml-3">HOME</a>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-6 pb-5">
        <div class="list-group shadow">
        @foreach ( $trades as $fifth)
            <a href="/{{$id}}/{{$first}}/{{$second}}/{{$third}}/{{$fourth}}/{{$fifth}}" class="list-group-item list-group-item-action">{{ $fifth }}</a>
        @endforeach
        </div>
    </div>
</div>
@endsection