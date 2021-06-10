@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Nowy student
                    </div>
                    <div class="card-body">
                        <form action="{{ action('App\Http\Controllers\UserController@addUserConfirm') }}" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nr albumu" name="album">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Imię" name="name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput3" placeholder="Nazwisko" name="surname">
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
            </div>
        </div>
    </div>
@endsection
