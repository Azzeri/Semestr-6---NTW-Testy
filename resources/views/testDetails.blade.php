@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h4><a href="{{ URL('showTests') }}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="dark"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg></a> {{ $testData->name }}</h4>
                @foreach ($testData->questionsInTest as $question)
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

            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        Akcje
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <form action="{{ action('App\Http\Controllers\TestController@addQuestionToTestConfirm') }}"
                                method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="test_id" value="{{ $testData->id }}" />
                                <div class="mb-3">
                                    <select name="question" class="form-select" aria-label="Default select example">
                                        @foreach ($questionData as $question)
                                            @php
                                                $flag = false;
                                                foreach ($testData->questionsInTest as $questionTest) {
                                                    if ($questionTest->id == $question->id) {
                                                        $flag = true;
                                                        break;
                                                    } else {
                                                        $flag = false;
                                                    }
                                                }
                                            @endphp
                                            @if ($flag == false)
                                                <option value="{{ $question->id }}">{{ $question->content }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" value="Dodaj pytanie do testu" class="btn-block rounded btn-dark" />
                            </form>
                        </div>
                        <div class="mb-3">
                            <form action="{{ action('App\Http\Controllers\TestController@assignStudentToTest') }}"
                                method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="test_id" value="{{ $testData->id }}" />
                                <div class="mb-3">
                                    <select name="student" class="form-select" aria-label="Default select example">
                                        @foreach ($studentData as $student)
                                            @php
                                                $flag = false;
                                                foreach ($testUnitData as $test) {
                                                    if ($test->assignedUser->album_student == $student->album_student) {
                                                        $flag = true;
                                                        break;
                                                    } else {
                                                        $flag = false;
                                                    }
                                                }
                                            @endphp
                                            @if ($student->constraintedUser->active == true && $flag == false)
                                                <option value="{{ $student->album_student }}">
                                                    {{ $student->album_student . ' ' . $student->name . ' ' . $student->surname }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" value="Przypisz do testu" class="btn-block rounded btn-dark" />
                            </form>
                        </div>
                        <div class="mb-3">
                            <form action="{{ action('App\Http\Controllers\TestController@assignGroupToTest') }}"
                                method="post" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="test_id" value="{{ $testData->id }}" />
                                <div class="mb-3">
                                    <select name="group" class="form-select" aria-label="Default select example">
                                        @foreach ($groupData as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" value="Przypisz do testu" class="btn-block rounded btn-dark" />
                            </form>
                        </div>
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
            </div>

            <div class="col-md">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nr albumu</th>
                            <th scope="col">Imię</th>
                            <th scope="col">Nazwisko</th>
                            <th scope="col">Wynik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testUnitData as $test)
                            @if ($test->assignedUser->constraintedUser->active == true)
                                <tr>
                                    <td>{{ $test->student_album }}</td>
                                    <td>{{ $test->assignedUser['name'] }}</td>
                                    <td>{{ $test->assignedUser['surname'] }}</td>
                                    @if ($test->finished == 1)
                                        <td class="text-center">{{ $test->result }}</td>
                                    @else
                                        <td>Nie rozwiązano</td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
