@extends('main')

@section('content')
<div class="row d-flex justify-content-center py-4">
    <div class="col-md-6">
        <div class="row d-flex flex-column">
            <h1 class="text-center display-3">First Category</h1>
            <a href="/" class="text-uppercase text-dark text-center font-weight-bold">BACK</a>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-6 pb-5">
        <div class="list-group shadow">
        @foreach ( $trades as $first)
            <a href="/{{$id}}/{{$first}}" class="list-group-item list-group-item-action">{{ $first }}</a>
        @endforeach
        </div>
    </div>
</div>
@endsection