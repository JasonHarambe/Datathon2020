@extends('main')

@section('content')
<div class="row d-flex justify-content-center py-4">
    <div class="col-md-6">
        <div class="row d-flex flex-column">
            <h1 class="text-center display-3">Second Category</h1>
            <div class="row d-flex flex-column mt-2">
                <p class="text-uppercase text-center text-muted">
                    <span class="d-inline-block text-truncate" style="max-width: 200px; vertical-align:top;">{{ $first }}</span>
                </p>
            </div>
            <div class="row d-flex justify-content-center">
                <a href="/{{$id}}" class="text-uppercase text-dark font-weight-bold">BACK</a>
                <a href="/" class="text-uppercase text-dark font-weight-bold ml-3">HOME</a>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-6 pb-5">
        <div class="list-group shadow">
        @foreach ( $trades as $second)
            <a href="/{{$id}}/{{$first}}/{{$second}}" class="list-group-item list-group-item-action">{{ $second }}</a>
        @endforeach
        </div>
    </div>
</div>
@endsection