@extends('main')

@section('content')
<div class="row">
    <nav class="col-3 d-none d-block bg-light sidebar">
        <div class = "sidebar-sticky" style="height:100%; position:fixed; width: 20%; overflow:scroll;">
            <ul class="nav flex-column pb-3 mb-5">
                <div class="row d-flex py-3 flex-column mx-3">
                    <h3 class="text-center">Category</h3>
                    <div class="row d-flex justify-content-center" style="height: 100px;">
                        <p class="text-uppercase text-center text-muted">
                            <span class="d-inline-block text-truncate small" style="max-width: 200px; vertical-align:top;">{{ $id }}</span>
                        </p>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <a href="/" class="btn btn-primary btn-sm text-uppercase" role='button'>home</a>
                    </div>
                </div>
                <!-- <a class="disabled list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-primary">
                    <h3 class="">Category.</h3>
                    <div class="col">
                        <a href="">back</a>
                    </div>
                   <div class="row d-flex flex-column">
                        <h3>Category.</h3>
                        <a class="btn btn-primary shadow text-center btn-sm mx-5 text-uppercase mt-2" href="/" role="button">Back</a>
                        <a href="#" class="next">Next &raquo;</a>
                   </div>
                </a> -->
                @foreach ($trades as $key => $value)
                    <a href="/{{ $id }}/{{ $value->desc }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        {{ $value->desc }}
                        <span class="badge badge-primary badge-pill">
                            {{ $value->total }}
                        </span>
                    </a>
                @endforeach
            </ul>
        </div>
    </nav>
    <!-- <div class="col-5">
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
                        <a href="/{{ $id }}/{{ $value->desc }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $value->desc }}
                            <span class="badge badge-primary badge-pill">{{ $value->total }}</span>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-9">
        @include('layouts.partials.page_graph')
    </div>
</div>
@endsection

@section('script')
    @include('layouts.partials.chart')
@endsection