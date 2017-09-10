@extends('layouts.header')
@section('content')
<div class="container" id="content">
<div class="row">
  <br>
    <div class="col s10 push-s1">
        <div  class="row">
            <div class=" col s12 center-align hide-on-med-and-up">
               <h5>Daftar Admin</h5>
            </div>
            <div class="col m6 l6 left-align hide-on-small-only">
                <h5>Daftar Admin</h5>
            </div>
            @if($userAdmin->role == 'superuser')
            <div class="col s12 center-align hide-on-med-and-up">
                <a href="#modal_admin" class="waves-effect waves-light btn blue-grey darken-4 add_admin" id="add_admin">Tambah</a>
            </div>
            <div class="col m6 l6 right-align hide-on-small-only">
                <a href="#modal_admin" class="waves-effect waves-light btn blue-grey darken-4 add_admin" id="add_admin">Tambah</a>
            </div>
            @endIf
        </div>
    </div>
    <div class="col s10 push-s1">
        <div class="card-panel">
            <table class="bordered highlight datatable" id="adminTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NPM</th>
                            <th>Fakultas</th>
                            <th>Pemilihan</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

<div id="modal_admin" class="modal modal-fixed-footer">
    <form id="add_admin_form" enctype="multipart/form-data" method="POST">
    <div class='modal-content'>
            <div class="col s10 push-s1">
             <br>
              {!! csrf_field() !!}
              <div class="row">
                 <h5 id="modal-title" class="header">Tambah Admin</h5>
                        <div class="divider"></div>
                    @if($userAdmin->role == 'superuser')
                      <div class="input-field col s12">
                         <label class="active">Fakultas</label>
                          <select  name="fakultas">
                          <option>Pilih Fakultas</option>
                            @foreach($daftarFakultas as $fakultas)
                                <option id="fakultas" value="{{ $fakultas->id}}">{{$fakultas->name}}</option>
                            @endforeach
                          </select>
                      </div>
                    @endif
                      <div class="input-field col s12">
                        <input id="username_admin" type="text" class="validate" name="username" required="required">
                        <label for="username">Username</label>

                      </div>
                      <div class="input-field col s12">
                        <input id="npm_admin" type="text" class="validate" name="npm" required="required">
                        <label for="npm">NPM</label>

                      </div>


                  </div>

            </div>
        </div>
        <div class="modal-footer">
          <div class="right">
            <button class="btn waves-effect waves-light blue-grey darken-4" type="submit" name="action" value="addAdmin" id="sub_btn">Submit</i>
            </button>
          </div>
        </div>
        </form>
</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
@endsection
