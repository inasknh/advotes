@extends('layouts.header')
@section('content')
  <div class="container" id="content">
    <br>
    <div class="row">
      <div class="col s6 push-s1 left-align">
        <h5>List Pemilihan {{!! $userAdmin->role !!}}</h5>
      </div>
      @if({{$userAdmin->role}} != "admin pemilihan")
      <div class="col s6 pull-s1 right-align">
        <a class="waves-effect waves-light btn blue-grey darken-4 modal-trigger" href="#tambah">Tambah</a>
      </div>
      @endif
  </div>

    <div class="row">
        <div class="card-panel col s10 push-s1">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                  <tr>
                      <td>Bem UI</td>
                      <td>1/1/2017</td>
                      <td>1/1/2017</td>
                      <td>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">edit</i>
                          </a>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">delete</i>
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td>Bem Fasilkom</td>
                      <td>1/1/2017</td>
                      <td>1/1/2017</td>
                      <td>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">edit</i>
                          </a>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">delete</i>
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td>Bem beman</td>
                      <td>1/1/2017</td>
                      <td>1/1/2017</td>
                      <td>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">edit</i>
                          </a>
                          <a class="waves-effect waves-light btn blue-grey darken-4">
                            <i class="material-icons">delete</i>
                          </a>
                      </td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="tambah" class="modal modal-fixed-footer">
  <form class="" action="index.html" method="post">
    <div class="modal-content">
      <h5>Tambah Pemilihan</h5>
      <div class="divider"></div>
      <div class="row">
        <div class="row col s6">
          <div class="card-panel col s12">
            <h5>Organisasi</h5><hr>
            <div class="row">
              <div class="input-field col s12">
                <input id="nama_pemilihan" type="text" class="validate" name="nama_pemilihan">
                <label for="nama_pemilihan">Nama Pemilihan</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s6">
                <input id="mulai" type="text" class="datepicker">
                <label for="mulai">Tanggal Mulai</label>
              </div>

              <div class="input-field col s6">
                <input id="akhir" type="text" class="datepicker">
                <label for="akhir">Tanggal Akhir</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row col s6">
          <div class="card-panel col s12">
            <h5>Admin Pemilihan</h5><hr>
            <div class="row">
              <div class="input-field col s12">
                <input id="nama_admin" type="text" class="validate" name="nama_admin">
                <label for="nama_admin">Nama Admin</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="npm" type="number" class="validate" name="npm">
                <label for="npm">NPM</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-light blue-grey darken-4 btn-flat white-text">Tambah</a>
    </div>
  </form>
</div>
@endsection
