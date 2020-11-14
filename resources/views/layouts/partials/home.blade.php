@extends('main')

@section('content')
<div class="row d-flex justify-content-center py-4">
    <div class="col-md-6">
        <h1 class="text-center display-3">Choose A Country</h1>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-6 pb-5">
        <div class="list-group shadow">
        @foreach ( $results as $result)
            <a href="/{{$result}}" class="list-group-item list-group-item-action">{{ $result }}</a>
        @endforeach
        </div>
    </div>
</div>
@endsection