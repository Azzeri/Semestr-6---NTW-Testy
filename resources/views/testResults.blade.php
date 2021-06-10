@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Zakończono test
            </div>
            <div class="card-body">
                @if ($feedback != null)
                    @foreach ($feedback as $key => $value)
                        <div class="card">
                            <div class="card-header">
                                {{ $key }}
                            </div>
                            <div class="card-body">
                                <h6 style="color:crimson;">{{ $value[0] }}<br></h6>
                                <h6 style="color:green;">{{ $value[1] }}</h6>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-footer text-right">
                <b>Punkty: {{ $points }}/{{ $pointsMax }}</b>
                <a href="{{ URL('showUserTests') }}" class="btn btn-dark">Powrót</a>
            </div>
        </div>
    </div>
@endsection
