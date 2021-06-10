@extends('layouts.app')
@section('content')
    <div class="container">
        <h4><a href="{{ URL('addGroup') }}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="dark"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg></a> {{ $groupData->name }}</h4>
        <div class="row">
            <table class="table table-hover col">
                <thead>
                    <tr>
                        <th scope="col">Nr albumu</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupData->studentsInGroup as $student)
                        @if ($student->constraintedUser->active == true)
                            <tr>
                                <td>{{ $student->album_student }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->surname }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dodaj studenta
                    </div>
                    <div class="card-body">
                        <form action="{{ action('App\Http\Controllers\GroupController@addToGroupConfirm') }}"
                            method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="group" value="{{ $groupData->id }}" />
                            <div class="mb-3">
                                <select name="album" class="form-select" aria-label="Default select example">
                                    @foreach ($studentData as $student)
                                        @php
                                            $flag = false;
                                            foreach ($groupData->studentsInGroup as $studentGroup) {
                                                if ($studentGroup->album_student == $student->album_student) {
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
                            <input type="submit" value="Dodaj" class="btn-block rounded btn-dark" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
