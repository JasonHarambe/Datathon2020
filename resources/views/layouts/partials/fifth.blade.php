@extends('main')

@section('content')
<div class="row">
    <nav class="col-3 d-none d-block bg-light sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column pb-3 mb-5">
                <div class="row d-flex py-3 flex-column mx-3">
                    <h3 class="text-center font-weight-bold">Category</h3>
                    <div class="row d-flex justify-content-center" style="height:100px;">
                        <p class="text-uppercase text-center text-muted">
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $id }}</span>
                            <span>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </span>
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $first }}</span>
                            <span>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </span>
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $second }}</span>
                            <span>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </span>
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $third }}</span>
                            <span>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="font-size:1.5em;">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </span>
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $fourth }}</span>
                        </p>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <a href="/" class="btn btn-primary btn-sm text-uppercase" role='button'>home</a>
                        <span class="mx-1"></span>
                        <a href="/master/{{ $id }}/{{ $first }}/{{ $second }}/{{ $third }}" class="btn btn-success btn-sm text-uppercase" role='button'>back</a>
                    </div>
                </div>
            @foreach ($trades as $key => $value)
                <a href="/master/{{ $id }}/{{ $first }}/{{ $second }}/{{ $third }}/{{ $fourth }}/{{ $value->desc }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    {{ $value->desc }}
                    <span class="badge badge-primary badge-pill">
                        {{ $value->total }}
                    </span>
                </a>
            @endforeach
            </ul>
        </div>
    </nav>
    <div class="col-9">
        @include('layouts.subs.page_graph')
    </div>
</div>
@endsection

@section('script')
    @include('layouts.subs.chart')
@endsection
