@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                @foreach ($questionsData as $question)
                    <div class="dropdown row mb-2">
                        <button class="text-left btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $question['content'] }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">{{ $question['ansA'] }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ $question['ansB'] }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ $question['ansC'] }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ $question['ansD'] }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ $question['ansCorrect'] }}</a></li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Nowe pytanie
                    </div>
                    <div class="card-body">
                        <form action="{{ action('App\Http\Controllers\QuestionController@addQuestionConfirm') }}"
                            method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Treść"
                                    name="content">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput2"
                                    placeholder="Odpowiedź A" name="ansA">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput3"
                                    placeholder="Odpowiedź B" name="ansB">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput3"
                                    placeholder="Odpowiedź C" name="ansC">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput3"
                                    placeholder="Odpowiedź D" name="ansD">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput3"
                                    placeholder="Odpowiedź poprawna" name="ansCorrect">
                            </div>
                            <input type="submit" value="Dodaj" class="btn-block rounded btn-dark" />
                        </form>
                    </div>
                    <div class="card-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endsection
