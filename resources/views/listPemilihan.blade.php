@extends('layouts.header')
@section('content')
<div class="container" id="content">
<div class="row">
    <br>
    <div class="col s6 push-s1 left-align" id="">
      <h5>List Pemilihan</h5>
      <h5 id="role" value="{{$userAdmin->role}}"></h5>
    </div>
    @if($userAdmin->role != 'admin pemilihan')
    <div class="col s6 pull-s1 right-align">
        <a class="waves-effect waves-light btn blue-grey darken-4 modal-trigger" href="#modal_pemilihan" id="add_pemilihan">Tambah</a>
    </div>
    @endif
    <div class="col s10 push-s1">
      <div class="card-panel">
        <div class="row">
            <div class="col s10 push-s1">
              <table class="bordered highlight dataTable" id="pemilihanTable">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
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
  </div>
</div>

<div id="modal_pemilihan" class="modal modal-fixed-footer">
  <form id="add_pemilihan_form" enctype="multipart/form-data" method="post">
  {!! csrf_field() !!}
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
                <input id="tanggal_mulai" type="text" class="datepicker" name="tanggal_mulai">
                <label for="tanggal_mulai">Tanggal Mulai</label>
              </div>

              <div class="input-field col s6">
                <input id="tanggal_selesai" type="text" class="datepicker" name="tanggal_selesai">
                <label for="tanggal_selesai">Tanggal Selesai</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row col s6" id="modal_admin_pemilihan">
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
                <input id="npm_admin" type="number" class="validate" name="npm_admin" maxlength="10">
                <label for="npm">NPM</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button class="waves-effect waves-light blue-grey darken-4 btn-flat white-text" type="submit" name="action" value="add" id="sub_btn">Tambah</button>
    </div>
  </form>
</div>    

<div id="modal_edit_pemilihan" class="modal modal-fixed-footer">
  <form id="edit_pemilihan_form" enctype="multipart/form-data" method="post">
  {!! csrf_field() !!}
    <div class="modal-content">
      <h5>Edit Pemilihan</h5>
      <div class="divider"></div>
      <div class="row">
        <div class="row col s12">
          <div class="card-panel col s12">
            <h5>Organisasi</h5><hr>
            <div class="row">
              <div class="input-field col s12">
                <input id="edit_nama_pemilihan" type="text" class="validate" name="nama_pemilihan">
                <label for="nama_pemilihan">Nama Pemilihan</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s6">
                <input id="edit_tanggal_mulai" type="text" class="datepicker" name="tanggal_mulai">
                <label for="tanggal_mulai">Tanggal Mulai</label>
              </div>

              <div class="input-field col s6">
                <input id="edit_tanggal_selesai" type="text" class="datepicker" name="tanggal_selesai">
                <label for="tanggal_selesai">Tanggal Selesai</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button class="waves-effect waves-light blue-grey darken-4 btn-flat white-text" type="submit" name="action" value="add" id="sub_btn">Tambah</button>
    </div>
  </form>
</div>    
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/pemilihan.js')}}"></script>
@endsection
