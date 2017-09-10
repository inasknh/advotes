$(document).ready(function() {
    var id_penjaga;
    var state_penjaga;
    var state_kandidat;
    var no_urut;
    var id_pemilihan = $("#select_pemilihan").val();
    getKandidat(id_pemilihan);

    $("#select_pemilihan").change(function() {
        $("#result").css("display", "none");
        $("#loader").css("display", "block");
        id_pemilihan = $(this).val();
        getKandidat(id_pemilihan);
    });

    console.log(id_pemilihan + " hahahaha");
    // getPenjagaTPS();
    getPenjagaDataTable();

    function getPenjagaDataTable(){
        $('#penjagaTPSTable').DataTable({
        processing : true,
        serverSide : true,
        responsive : true,
        ajax: '/penjagaTPS/list',
        columns : [
            {data : 'nama', name :'nama'},
            {data : 'npm', name: 'npm'},
            {data : 'imei', name : 'imei'},
            {data : 'id', name : 'id', sortable : false,
                render : function (data, type, full){
                    return '<button value="' + data + '"' +
                        'id="edit_penjaga_id" class="waves-effect waves-light btn blue-grey darken-4 edit_penjaga">' +
                        '<i class="material-icons" value="' + data + '">edit</i></button>';
                }
            },
            {data : 'id', name : 'id', sortable : false,
                render : function(data, type, full){
                    return '<button value="' + data + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus penjaga TPS ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_penjaga">'+
                        '<i class="material-icons">delete</i></button>';
                }
            }
        ]
    });
    }

    function getPenjagaTPS() {
        console.log("masuk get");
        $.ajax({
            type: "GET",
            url: '/penjagaTPS/list',
            dataType: "JSON",
            data:{} ,
            success: function(data) {
                var table = $("#penjagaTPStable");
                var thead = table.find("thead");
                var tbody = table.find("tbody");
                tbody.empty();

                var tableHead = "<tr>"+
                            // "<th>No </th>"+
                            "<th>Nama</th>"+
                            "<th>NPM</th>"+
                            "<th>IMEI</th>"+
                            "<th>Ubah</th>"+
                            "<th>Hapus</th>"+
                        "</tr>";


                if (data.length < 1) {
                    thead.text("Anda belum memiliki penjaga TPS");
                }
                else {
                    thead.text("");
                    thead.append(tableHead);
                    for (var i = 0; i < data.length; i++) {
                        var penjagaList = "<tr>";
                        penjagaList += "<td>" + (i + 1) + "</td>";
                        penjagaList += "<td>" + data[i].nama + "</td>";
                        penjagaList += "<td>" + data[i].npm + "</td>";
                        penjagaList += "<td>" + data[i].imei + "</td>";
                        penjagaList += '<td><button value="' + data[i].id + '"' +
                        'id="edit_penjaga_id" class="btn medium blue-grey darken-4 edit_penjaga"><i class="material-icons" value="' + data[i].id + '">edit</i></button>' +
                        '</td>' +
                        '<td>' +
                        '<button value="' + data[i].id + '"' +
                        ' onclick="return confirm("Apakah Anda yakin ingin menghapus penjaga ini?")"' +
                        ' class="btn medium  blue-grey darken-4 lighten-1 delete_penjaga"><i class="material-icons">delete</i></button>' +
                        '</td>';
                        penjagaList += "</tr>";
                        tbody.append(penjagaList);
                    }

                }
                $("#loader").css("display", "none");
                $("#result").css("display", "block");
            },
            error: function(err) {
                console.log("get penjagaTPS error");
            }
        });
    }

    $('.add_penjaga').click(function() {
        $("#modal-title").text("Tambah Penjaga TPS");
        state_penjaga = $("#sub_btn").val("add");
        $('#add_penjaga_form')[0].reset();
    });

    $('#add_penjaga_medium').click(function() {
        state_penjaga = $("#sub_btn").val("add");
        $('#add_penjaga_form')[0].reset();
    });

    $("#add_penjaga_form").submit(function(e){
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state_penjaga = $("#sub_btn").val();
        // id_penjaga = $("#edit_penjaga_id").val();
        console.log(id_penjaga +" sebelum if");

        if(state_penjaga == "add") {
            $.ajax({
                url:"/penjagaTPS/store/",
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    // getPenjagaTPS();
                    $('#penjagaTPSTable').DataTable().destroy();
                    getPenjagaDataTable();
                    Materialize.toast('Penjaga TPS Berhasil Ditambahkan!', 2000);
                    $("#modal_penjaga").modal('close');
                },
                error:function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.nama){
                        Materialize.toast('Penjaga TPS Gagal Ditambahkan. ERROR: ' + $errors.nama, 4000);
                    }
                    if($errors.npm){
                        Materialize.toast('Penjaga TPS Gagal Ditambahkan. ERROR: ' + $errors.npm, 4000);
                    }
                    if($errors.imei){
                        Materialize.toast('Penjaga TPS Gagal Ditambahkan. ERROR: ' + $errors.imei, 4000);
                    }
                }

            });
        }
        if(state_penjaga == "update") {
            console.log(id_penjaga + " id_penjaga di update");
            $.ajax({
                url:'/penjagaTPS/update/' + id_penjaga,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",
                success: function(data) {
                    // getPenjagaTPS();
                    $('#penjagaTPSTable').DataTable().destroy();
                    getPenjagaDataTable();
                    Materialize.toast('Penjaga TPS Berhasil Diubah', 2000);
                    $("#modal_penjaga").modal("close");
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.nama){
                        Materialize.toast('Penjaga TPS Gagal Diubah. ERROR: ' + $errors.nama, 4000);
                    }
                    if($errors.npm){
                        Materialize.toast('Penjaga TPS Gagal Diubah. ERROR: ' + $errors.npm, 4000);
                    }
                    if($errors.imei){
                        Materialize.toast('Penjaga TPS Gagal Diubah. ERROR: ' + $errors.imei, 4000);
                    }
                }
            });
        }
    });

    $(document).on('click', '.delete_penjaga', function() {
        if(confirm('Apakah Anda yakin ingin menghapus penjaga ini?')){
            var id = $(this).val();
          //  console.log(id_penjaga);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: '/penjagaTPS/delete/' + id,
                success: function(data) {
                    $('#penjagaTPSTable').DataTable().destroy();
                    getPenjagaDataTable();
                    Materialize.toast('Penjaga TPS Berhasil Dihapus!', 2000);
                    // getPenjagaTPS();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Materialize.toast('penjaga TPS Gagal Dihapus!', 2000);
                }
            });
        }
    });

    $(document).on('click', '.edit_penjaga', function() {
        $("#modal-title").text("Edit Penjaga TPS");
        id_penjaga = $(this).val();
        console.log(id_penjaga + " di edit_penjaga");
        $.ajax({
            type: "GET",
            url: '/penjagaTPS/edit',
            dataType: "JSON",
            data: {
                'id' : id_penjaga
            },
            success: function(data) {

                console.log(data[0].nama + " nama nol");
                $('#add_penjaga_form')[0].reset();
                $("#sub_btn").val("update");
                $("#npm_penjaga").val(data[0].npm);
                $("#nama_penjaga").val(data[0].nama);
                $("#imei_penjaga").val(data[0].imei);

            },
            error: function(data) {}
        });
        $("#modal_penjaga").modal('open');
    });

    //////////////////////////////// Kandidat ///////////////////////////////

    function makeModal(double){
        var modalKandidat = '';
        if(double){
            modalKandidat += '<div class = "modalKandidat col s12 m6 l6">';
            modalKandidat += '<h6>Calon Ketua</h6>';
            modalKandidat += '<div class="file-field input-field">';
            modalKandidat += '<div class="blue-grey darken-4 btn">';
            modalKandidat += '<span>File</span>';
            modalKandidat += '<input type="file" name="path_foto_ketua" id="path_foto_ketua" placeholder="Foto Calon" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '<div class="file-path-wrapper">';
            modalKandidat += '<input class="file-path validate" type="text" placeholder="Upload File" name="path_foto_ketua" id="path_foto_ketua" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="nama_ketua" id="nama_ketua" required="true">';
            modalKandidat += '<label for="nama_ketua">Nama Calon Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="npm_ketua" id="npm_ketua" required="true">';
            modalKandidat += '<label for="npm_ketua">NPM Calon Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
            modalKandidat += '<hr class="modalKandidat hide-on-med-and-up">';
            modalKandidat += '<div class = "modalKandidat col s12 m6 l6">';
            modalKandidat += '<h6>Calon Wakil Ketua</h6>';
            modalKandidat += '<div class="file-field input-field">';
            modalKandidat += '<div class="blue-grey darken-4 btn">';
            modalKandidat += '<span>File</span>';
            modalKandidat += '<input type="file" name="path_foto_wakil" id="path_foto_wakil" placeholder="Foto Calon" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '<div class="file-path-wrapper">';
            modalKandidat += '<input class="file-path validate" type="text" placeholder="Upload File" name="path_foto_wakil" id="path_foto_wakil" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="nama_wakil" id="nama_wakil" required="true">';
            modalKandidat += '<label for="nama_wakil">Nama Calon Wakil Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="npm_wakil" id="npm_wakil" required="true">';
            modalKandidat += '<label for="npm_wakil">NPM Calon Wakil Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
        }else{
            modalKandidat += '<div class = "modalKandidat col s12 m12 l12">';
            modalKandidat += '<h6>Calon Ketua</h6>';
            modalKandidat += '<div class="file-field input-field">';
            modalKandidat += '<div class="blue-grey darken-4 btn">';
            modalKandidat += '<span>File</span>';
            modalKandidat += '<input type="file" name="path_foto_ketua" id="path_foto_ketua" placeholder="Foto Calon" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '<div class="file-path-wrapper">';
            modalKandidat += '<input class="file-path validate" type="text" placeholder="Upload File" name="path_foto_ketua" id="path_foto_ketua" required="true">';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="nama_ketua" id="nama_ketua" required="true">';
            modalKandidat += '<label for="nama_ketua">Nama Calon Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '<div class="input-field">';
            modalKandidat += '<input type="text" class="validate" name="npm_ketua" id="npm_ketua" required="true">';
            modalKandidat += '<label for="npm_ketua">NPM Calon Ketua</label>';
            modalKandidat += '</div>';
            modalKandidat += '</div>';
        }
        return modalKandidat
    }

    function getKandidat(id) {
        console.log("masuk kandidat");

        $.ajax({
            type: "GET",
            url: '/kandidat/listKandidat',
            dataType: "JSON",
            data: {
                'id': id
            },

            success: function(data) {
                var table = $("#table_kandidat");
                var thead = table.find("thead");
                var tbody = table.find("tbody");
                tbody.empty();

                var tableHead = "<tr>"+
                            "<th>No Urut</th>"+
                            "<th>Foto</th>"+
                            "<th>Nama</th>"+
                            "<th>NPM</th>"+
                            "<th>Ubah</th>"+
                            "<th>Hapus</th>"+
                        "</tr>";

                if(data.length < 1) {
                    no_urut = 1;
                    thead.text("Anda belum memiliki kandidat");
                } else {
                    no_urut = data[data.length - 1].no_urut+1;
                    thead.text("");
                    thead.append(tableHead);
                }

                $("#no_urut").val(no_urut);
                $(".list-kandidat").remove();
                var doubleKandidat = false;

                    for (var i = 0; i < data.length; i++) {
                        var kandidatList = "<div class='list-kandidat row col s12 m6 l6'><div class='statistik-content card-panel col s10 push-s1'>";

                        kandidatList += "<nav class='top-nav blue-grey darken-4'><div class='nav-wrapper'><a class='brand-logo center'>" + data[i].no_urut + "</div></nav>";

                        kandidatList += "<div class='row'><br>";

                        if(data[i].nama_wakil != null) {
                            doubleKandidat = true;
                            kandidatList += "<div class='col s12 m6 l6 center-align'><div class='row'><div class='col s3'></div><div class='col s6 valign-wrapper'>";
                            kandidatList += "<img class='responsive-img valign' src='images/candidates/"+data[i].path_foto_ketua+"'>";
                            kandidatList += "</div></div><p>" + data[i].nama_ketua + "</p><p>" + data[i].npm_ketua + "</p></div>";
                            kandidatList += "<div class='divider hide-on-med-and-up'></div>";
                            kandidatList += "<div class='col s12 m6 l6 center-align'><div class='row'><div class='col s3'></div><div class='col s6 valign-wrapper'>";
                            kandidatList += "<img class='responsive-img valign' src='images/candidates/"+data[i].path_foto_wakil+"'>";
                            kandidatList += "</div></div><p>" + data[i].nama_wakil + "</p><p>" + data[i].npm_wakil + "</p></div>";
                        }else{
                            kandidatList += "<div class='col s12 m12 l12 center-align'><div class='row'><div class='col s4'></div><div class='col s4 valign-wrapper'>";
                            kandidatList += "<img class='responsive-img valign' src='images/candidates/"+data[i].path_foto_ketua+"'>";
                            kandidatList += "</div></div><p>" + data[i].nama_ketua + "</p><p>" + data[i].npm_ketua + "</p></div>";
                        }

                        kandidatList += "<div class='right-align col s6'>";
                        kandidatList += "<button value='" + data[i].no_urut + "' id='edit_pemilihan_id' class='btn medium blue-grey darken-4 edit_kandidat'><i class='material-icons'>edit</i></button>";
                        kandidatList += "</div>";
                        kandidatList += "<div class='left-align col s6'>";
                        kandidatList += "<button value='" + data[i].no_urut + "' onclick='return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')' class='btn medium blue-grey darken-4 delete_kandidat'><i class='material-icons'>delete</i></button>";
                        kandidatList += "</div>";

                        kandidatList += "<br></div>";
                        kandidatList += "</div></div>";
                    $("#table_kandidat").append(kandidatList);
                    console.log("get kandidat ada ");
                    }

                $("#loader").css("display", "none");
                $("#result").css("display", "block");
                // }
            },
            error: function(data) {
                console.log("get kandidat error " + datas);
            }
        });
    }

    $('#add_kandidat').click(function() {
        $("#modal-title").text("Tambah Kandidat");
        state_kandidat = $("#submit_kandidat").val("add");
        $('#add_kandidat_form')[0].reset();
        $("#no_urut").val(no_urut);
    });

    $("#add_kandidat_form").submit(function(e){
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state_kandidat = $("#submit_kandidat").val();
        var no_urut = $("#no_urut").val();
        console.log(id_pemilihan +" id pemilihan sebelum if dan no urut" + no_urut);

        if(state_kandidat == "add") {
            console.log("masuk add");
            $.ajax({
                url:"/kandidat/store/" + id_pemilihan,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    getKandidat(id_pemilihan);
                    Materialize.toast('Kandidat Berhasil Ditambahkan!', 2000);
                    $("#modal_kandidat").modal('close');
                },
                error:function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.no_urut){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.no_urut, 3000);
                    }
                    if($errors.nama_ketua){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.nama_ketua, 3000);
                    }
                    if($errors.path_foto_ketua){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.path_foto_ketua, 3000);
                    }
                    if($errors.npm_ketua){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.npm_ketua, 3000);
                    }
                    if($errors.nama_wakil){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.nama_wakil, 3000);
                    }
                    if($errors.path_foto_wakil){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.path_foto_wakil, 3000);
                    }
                    if($errors.npm_wakil){
                        Materialize.toast('Kandidat Gagal Ditambahkan. ERROR: ' + $errors.npm_wakil, 3000);
                    }
                }

            });
        }
        if(state_kandidat == "update") {
            console.log(id_pemilihan + " id_pemilihan di update");
            $.ajax({
                url:"/kandidat/update/" + id_pemilihan + '/' + no_urut,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",
                success: function(data) {
                    getKandidat(id_pemilihan);
                    Materialize.toast('Kandidat Berhasil Diubah', 2000);
                    $("#modal_kandidat").modal("close");
                },
                error:function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.no_urut){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.no_urut, 3000);
                    }
                    if($errors.nama_ketua){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.nama_ketua, 3000);
                    }
                    if($errors.path_foto_ketua){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.path_foto_ketua, 3000);
                    }
                    if($errors.npm_ketua){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.npm_ketua, 3000);
                    }
                    if($errors.nama_wakil){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.nama_wakil, 3000);
                    }
                    if($errors.path_foto_wakil){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.path_foto_wakil, 3000);
                    }
                    if($errors.npm_wakil){
                        Materialize.toast('Kandidat Gagal Diubah. ERROR: ' + $errors.npm_wakil, 3000);
                    }
                }
            });
        }
    });

    $(document).on('click', '.edit_kandidat', function(){
        var no_urut = $(this).val();
        console.log("masuk .edit_kandidat" + no_urut);
        $.ajax({
            type:"GET",
            url: '/kandidat/list',
            dataType: "JSON",
            data: {
                'id' : id_pemilihan,
                'no_urut': no_urut
            },
            success: function(data) {
                $("#submit_kandidat").val("update");
                $('#add_kandidat_form')[0].reset();
                $("#no_urut").val(data.no_urut);
                $("#nama_ketua").val(data.nama_ketua);
                $("#nama_wakil").val(data.nama_wakil);
                $("#npm_ketua").val(data.npm_ketua);
                $("#npm_wakil").val(data.npm_wakil);
                console.log("sukses " + data.no_urut);
            },
            error: function(data) {
                console.log("gagal edit " + data);
            }

        });
        $("#modal-title").text("Edit Kandidat");
        $("label").addClass("active");
        Materialize.updateTextFields();
        $("#modal_kandidat").modal("open");
    });

    $(document).on('click', '.delete_kandidat', function(){
        if(confirm('Apakah Anda yakin ingin menghapus kandidat ini?')) {
            var no_urut = $(this).val();
            console.log(no_urut + " delete kandidat");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type:"GET",
                url: '/kandidat/delete/' + id_pemilihan + '/' + no_urut,
                success: function(data) {
                    Materialize.toast('Kandidat Berhasil Dihapus', 2000);
                    getKandidat(id_pemilihan);
                },
                error: function(data) {
                    console.log('Error delete kandidat ' + data);
                    Materialize.toast('Kandidat Gagal Dihapus!', 2000);
                }
            });
        }
    });


});
