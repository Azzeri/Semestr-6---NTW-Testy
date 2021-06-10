 @extends('layouts.app')
 @section('content')

     <div class="container">
         <div class="row">
             <div class="col-md-6 offset-md-3">
                 <div class="card">
                     <div class="card-header">
                         Edycja studenta
                     </div>
                     <div class="card-body">
                         <form action="{{ action('App\Http\Controllers\UserController@editUserConfirm') }}" method="post"
                             role="form">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                             <input type="hidden" name="studentAlbum" value="{{ $studentData->album_student }}" />
                             <input type="hidden" name="userId" value="{{ $userData->id }}" />
                             <div class="mb-3">
                                 <input type="text" class="form-control" id="formGroupExampleInput"
                                     value="{{ $studentData->album_student }}" name="album" disabled>
                             </div>
                             <div class="mb-3">
                                 <input type="text" class="form-control" id="formGroupExampleInput2"
                                     value="{{ $studentData->name }}" name="name">
                             </div>
                             <div class="mb-3">
                                 <input type="text" class="form-control" id="formGroupExampleInput3"
                                     value="{{ $studentData->surname }}" name="surname">
                             </div>
                             <input type="submit" value="Zapisz" class="btn-block rounded btn-dark" />
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
