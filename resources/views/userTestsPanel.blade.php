@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Test</th>
                    <th>Zakończony</th>
                    <th>Wynik</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testsUnitData as $testUnit)
                    <tr>
                        <td>{{ $testUnit->assignedTest['name'] }}</td>
                        <td>{{ $testUnit->finished }}</td>
                        @if ($testUnit->finished == 0)
                            <td>Nie rozwiązano</td>
                            <td><a href="{{ URL('showTestToSolve/') . $testUnit['id'] }}">Rozwiąż</a></td>
                        @else
                            <td>{{ $testUnit->result }}</td>
                            <td>Rozwiązano</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
