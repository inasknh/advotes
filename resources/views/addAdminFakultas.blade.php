@extends('layouts.header')
@section('content')
<div class="container" id="content">
    <div class="col s10 push-s1">
      <div class="card-panel">
        <div  class="row">
            <div class="col s10 push-s1">
             @if (session('message')) {{session('message')}} @endif
             <br>
            <form method="POST" action="{{url('/adminFakultas/store')}}">
              {!! csrf_field() !!}
              <div class="row">
                      <div class="input-field col s12">
                         <label class="active">Fakultas</label>
                          <select  name="fakultas">
                          <option>Pilih Fakultas</option>
                            @foreach($daftarFakultas as $fakultas)
                                <option id="fakultas" value="{{ $fakultas->id}}">{{$fakultas->name}}</option>
                            @endforeach
                          </select>
                        
                      </div>
                      <div class="input-field col s12">
                        <input id="username" type="text" class="validate" name="username" required="required">
                        <label for="username">Username</label>
                        
                      </div>
                      <div class="input-field col s12">
                        <input id="npm" type="text" class="validate" name="npm" required="required">
                        <label for="npm">NPM</label>
                       
                      </div>
                      
                      <div class="center-align col s12">
                        <br><br>
                        <button class="btn waves-effect waves-light blue-grey darken-4" type="submit" name="action">Save<i class="material-icons right">send</i>
                        </button>
                      </div>
                  </div>
              </form>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection