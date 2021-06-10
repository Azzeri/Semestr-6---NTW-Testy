@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Dane administratora
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $adminData->email }}</h5>
                        <form action="{{ action('App\Http\Controllers\UserController@changeAdminData') }}" method="post"
                            role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3">
                                <input type="password" class="form-control" id="formGroupExampleInput"
                                    placeholder="Obecne hasło" name="oldpass">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="formGroupExampleInput2"
                                    placeholder="Nowe hasło" name="newpass">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="formGroupExampleInput3"
                                    placeholder="Potwierdź hasło" name="confirmpass">
                            </div>
                            <input type="submit" value="Zapisz" class="btn-block btn-dark rounded" />
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
