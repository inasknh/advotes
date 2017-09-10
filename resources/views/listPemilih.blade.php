@extends('layouts.header')
@section('content')
<div class="container" id="content">
<div class="row">
    <br>
    <div class="col s10 push-s1">
        <div class="row">
            <div class=" col s12 center-align hide-on-med-and-up">
               <h5 class="left">Daftar Pemilihan</h5>
            </div>

            <div class=" col s5 left-align hide-on-small-only">
              <h5 class="left">Daftar Pemilihan</h5>
            </div>

            <div class=" col s12 l7">
            <div class="input-field col s12">
                <select id="select_pemilihan">
                @if($userAdmin->role == 'admin fakultas')
                      @foreach ($daftarPemilihan as $pemilihan)
                      <option value="{{ $pemilihan->id }}">{{ $pemilihan->nama }}</option>
                      @endforeach
                @elseif($userAdmin->role == 'admin pemilihan')
                    @foreach ($daftarPemilihan as $pemilihan)
                    <option value="{{ $pemilihan->id }}">{{ $pemilihan->nama }}</option>
                    @endforeach
                @endif
                </select>
                <label>Pilih Pemilihan</label>
           </div>
          </div>
        </div>
    </div>
    <div class="col s10 push-s1">
        <div class="card-panel">
        <div class="row">
            <div class="col s6 left-align hide-on-small-only">
                <h5>Daftar Pemilih Tetap</h5>
            </div>

            <div class=" col s12 center-align hide-on-med-and-up">
                <h5>Daftar Pemilih Tetap</h5>
            </div>

            <div class="col m6 l6 right-align hide-on-small-only">
                <a class="waves-effect waves-light btn blue-grey darken-4 add_pemilih" href="#modal_pemilih">Tambah</a>
            </div>

            <div class="col s12 center-align hide-on-med-and-up">
                <a class="waves-effect waves-light btn blue-grey darken-4 add_pemilih" href="#modal_pemilih">Tambah</a>
            </div>

         </div>
         <div class="divider"></div>
         <br>
         <div class="row">
                <table class="bordered highlight datatable" id="pemilihTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NPM</th>
                            <th>Ubah</th>
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

<div id="modal_pemilih" class="modal modal-fixed-footer">
          <div class='modal-content'>
            <h5 id="modal-title">Tambah Pemilih Tetap</h5>
              <div class="divider"></div>
                <div class="row">
                  <div class="row col s12 m6 l6">
                    <div class=" col s12">
                      <div class="card-panel inputPemilih">
                        <!-- put content here -->
                        <h5>File</h5>
                        <div class="divider"></div>
                        <form class="" id="add_excel_pemilih_form" enctype="multipart/form-data" method="post">
                          {!! csrf_field() !!}
                          <div class="fillerExcel">
                            <p>Download template excel <a href="/pemilih/downloadTemplate">di sini</a></p>
                            <p>Download contoh template <a href="/pemilih/downloadExample">di sini</a></p>
                          </div>
                          <div class="file-field input-field">
                            <div class="blue-grey darken-4 btn">
                              <span>File</span>
                              <input type="file" name="import_file" placeholder="Excel file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" name="import_file">
                            </div>
                          </div>
                          <div class="divider"></div><br>
                          <div class="right-align">
                            <button type="submit" class="waves-effect waves-light btn blue-grey darken-4" name="action" value="addExcel" id="sub_btn_excel">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="row col s12 m6 l6">
                    <div class=" col s12">
                      <div class="card-panel inputPemilih">
                        <!-- put content here -->
                        <h5>Manual</h5>
                        <div class="divider"></div>
                        <form id="add_pemilih_form" enctype="multipart/form-data" method="post">
                          {!! csrf_field() !!}
                          <div class="input-field">
                           <input id="nama_pemilih" type="text" class="validate" name="nama" required="required">
                           <label for="username">Nama</label>
                          </div>
                          <div class="input-field">
                            <input id="npm_pemilih" type="text" class="validate" name="npm" required="required" maxlength="10">
                            <label for="npm">NPM</label>
                          </div>
                          <div class="divider"></div><br>
                          <div class="right-align">
                            <button type="submit" class="waves-effect waves-light btn blue-grey darken-4" name="action" value="add" id="sub_btn">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/pemilih.js')}}"></script>
@endsection
