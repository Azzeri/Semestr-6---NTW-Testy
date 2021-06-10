@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (Auth::check() == true)
                    @if (Auth::user()->privilege == 'student')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Witaj
                                    {{ Auth::user()->student->name . ' ' . Auth::user()->student->surname }}</h5>
                                <a href="{{ URL('showUserTests') }}" class="btn btn-dark">Testy</a>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header text-center">
                                Panel administratora
                            </div>
                            <div class="card-body mx-auto">
                                <a href="{{ URL('showusers') }}" class="btn btn-dark">Studenci</a>
                                <a href="{{ URL('addGroup') }}" class="btn btn-dark">Klasy</a>
                                <a href="{{ URL('showQuestions') }}" class="btn btn-dark">Pytania</a>
                                <a href="{{ URL('showTests') }}" class="btn btn-dark">Testy</a>
                                <a href="{{ URL('showAdminPanel') }}" class="btn btn-dark">Konto</a>
                            </div>
                        </div>
                    @endif
                @else
                    <script>
                        window.location = "/login";

                    </script>
                @endif

            </div>
        </div>
    </div>
@endsection
