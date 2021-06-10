@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $testData->name }}
            </div>
            <div class="card-body">
                <form action="{{ action('App\Http\Controllers\TestController@showTestToSolveValidate') }}" method="post"
                    role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="testunit" value="{{ $testUnit->id }}" />
                    @foreach ($questionsData->shuffle() as $question)
                        <div class="card mb-2">
                            <div class="card-header">
                                @php
                                    $arr = [$question->ansA, $question->ansB, $question->ansC, $question->ansD];
                                    shuffle($arr);
                                @endphp
                                {{ $question->content }}
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                        id="flexRadioDefault1" value="{{ $arr[0] }}" required>
                                    <label class="form-check-label">
                                        {{ $arr[0] }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                        id="flexRadioDefault2" value="{{ $arr[1] }}" required>
                                    <label class="form-check-label">
                                        {{ $arr[1] }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                        id="flexRadioDefault3" value="{{ $arr[2] }}">
                                    <label class="form-check-label" required>
                                        {{ $arr[2] }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                        id="flexRadioDefault4" value="{{ $arr[3] }}">
                                    <label class="form-check-label" required>
                                        {{ $arr[3] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="submit" value="Zakończ test" class="btn btn-dark float-end" />
                </form>
            </div>
        </div>
    </div>
@endsection
