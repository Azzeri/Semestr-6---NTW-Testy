@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-hover col">
                <thead>
                    <tr>
                        <th>Test</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testsData as $test)
                        <tr>
                            <td>{{ $test['name'] }}</td>
                            <td class="text-center">
                                <a href="{{ URL('testDetails/') . $test['id'] }}"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="dark" class="bi bi-arrow-right-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                    </svg></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Nowy test
                    </div>
                    <div class="card-body">
                        <form action="{{ action('App\Http\Controllers\TestController@addTestConfirm') }}" method="post"
                            role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nazwa"
                                    name="name">
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
