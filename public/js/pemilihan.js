$(document).ready(function() {
	var id_pemilihan;
	var state;
    var role = $('#role').attr("value");
    console.log("role " + role);
    // getPemilihan();
    getPemilihanDataTable();

    function getPemilihanDataTable(){        
        $('#pemilihanTable').DataTable({
        processing : true,
        serverSide : true,
        responsive : true,
        ajax: '/pemilihan/list',
        columns : [
            {data : 'nama', name :'nama'},
            {data : 'tanggal_mulai', name: 'tanggal_mulai'},
            {data : 'tanggal_selesai', name : 'tanggal_selesai'},
            {data : 'id', name : 'id', sortable : false,
                render : function (data, type, full){
                    return '<button value="' + data + '"' +
                        'id="edit_pemilihan_id" class="waves-effect waves-light btn blue-grey darken-4 edit_pemilihan">' +
                        '<i class="material-icons" value="' + data + '">edit</i></button>';
                }
            },
            {data : 'id', name : 'id', sortable : false,
                render : function(data, type, full){
                    return '<button value="' + data + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus pemilihan ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_pemilihan">'+
                        '<i class="material-icons">delete</i></button>';
                }
            }
        ]
    });
    }

	function getPemilihan() {
        console.log("masuk get");
        $.ajax({
            type: "GET",
            url: '/pemilihan/list',
            dataType: "JSON",
            data:{} ,
            success: function(data) {
                var table = $("#pemilihanTable");
                var thead = table.find("thead");
                var tbody = table.find("tbody");
                tbody.empty();

                var tableHead = "<tr>"+
                            "<th>Nama</th>"+
                            "<th>Tanggal Mulai</th>"+
                            "<th>Tanggal Selesai</th>"+
                            "<th>Edit</th>"+
                            "<th>Hapus</th>"+
                        "</tr>";


                if (data.length < 1) {
                    thead.text("Anda belum memiliki pemilihan");
                }
                else {
                    thead.text("");
                    thead.append(tableHead);
                    for (var i = 0; i < data.length; i++) {
                        var pemilihanList = "<tr>";
                        // pemilihanList += "<td>" + (i + 1) + "</td>";
                        pemilihanList += "<td>" + data[i].nama + "</td>";
                        pemilihanList += "<td>" + data[i].tanggal_mulai+ "</td>";
                        pemilihanList += "<td>" + data[i].tanggal_selesai + "</td>";
                        pemilihanList += '<td><button value="' + data[i].id + '"' +
                        'id="edit_pemilihan_id" class="waves-effect waves-light btn blue-grey darken-4 edit_pemilihan"><i class="material-icons" value="' + data[i].id + '">edit</i></button>' +
                        '</td>' +
                        '<td>' +
                        '<button value="' + data[i].id + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus pemilihan ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_pemilihan"><i class="material-icons">delete</i></button>' +
                        '</td>';
                        pemilihanList += "</tr>";
                        tbody.append(pemilihanList);
                    }

                }
                $("#loader").css("display", "none");
                $("#result").css("display", "block");
            },
            error: function(err) {
                console.log("get pemilihan error");
            }
        });
    }

    $('#add_pemilihan').click(function() {
        state = $("#sub_btn").val("add");
        $('#add_pemilihan_form')[0].reset();
    });


    $("#add_pemilihan_form").submit(function(e){ 
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state = $("#sub_btn").val();
        $idPemilihan = $("#edit_pemilihan_id").val();
        $namaPemilihan = $('#nama_pemilihan').val();
        $tanggalMulai = $('#tanggal_mulai').val();
        $tanggalSelesai = $('#tanggal_selesai').val();
        $namaAdmin = $('#nama_admin').val();
        $npmAdmin = $('#npm_admin').val();

        if(state == "add") {
            $.ajax({
                url:"/pemilihan/store/",
                processData: false, 
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    $('#pemilihanTable').DataTable().destroy();
                    getPemilihanDataTable();
                    Materialize.toast('Pemilihan Berhasil Ditambahkan!', 2000);
                    $("#modal_pemilihan").modal('close');
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.nama){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.nama, 4000);
                    }
                    if($errors.tanggal_mulai){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.tanggal_mulai, 4000);
                    }
                    if($errors.tanggal_selesai){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.tanggal_selesai, 4000);
                    }
                    if($errors.nama_pemilihan){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.nama_pemilihan, 4000);
                    }
                    if($errors.npm_admin){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.npm_admin, 4000);
                    }
                    if($errors.nama_admin){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.nama_admin, 4000);
                    }

                }

            });
        }
        if(state == "update") {
            console.log($idPemilihan + " id_pemilihan di update");
            $.ajax({
                url:'/pemilihan/update/' + $idPemilihan,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",
                success: function(data) {
                    // getPemilihan();
                    $('#pemilihanTable').DataTable().destroy();
                    getPemilihanDataTable();
                    Materialize.toast('Pemilihan Berhasil Diubah', 2000);
                    $("#modal_pemilihan").modal("close");
                }, 
                error:  function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.nama){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.nama, 4000);
                    }
                    if($errors.tanggal_mulai){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.tanggal_mulai, 4000);
                    }
                    if($errors.tanggal_selesai){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.tanggal_selesai, 4000);
                    }
                    if($errors.nama_pemilihan){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.nama_pemilihan, 4000);
                    }
                    if($errors.npm_admin){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.npm_admin, 4000);
                    }
                    if($errors.nama_admin){
                        Materialize.toast('Admin Gagal Diubah. ERROR: ' + $errors.nama_admin, 4000);
                    }

                }
            });
        }
    });

     $(document).on('click', '.delete_pemilihan', function(e) {
        if(confirm('Are you sure you want to delete this?')){
            var id = $(this).val();
          //  console.log(id_penjaga);
            $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();


            $.ajax({
                type: "POST",
                url: '/pemilihan/delete/' + id,
                data: {
                    'id' : id
                },
                success: function(data) {
                    $('#pemilihanTable').DataTable().destroy();
                    getPemilihanDataTable();
                    Materialize.toast('Pemilihan Berhasil Dihapus!', 2000);
                    // getPemilihan();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Materialize.toast('Pemilihan Gagal Dihapus!', 2000);
                }
            });
        }
    });

    $(document).on('click', '.edit_pemilihan', function() {
        var id_pemilihan = $(this).val();
        console.log("id Pemilihan " + id_pemilihan);
        console.log("role login " + role);
        if(role === "admin fakultas"){
            $.ajax({
                type: "GET",
                url: '/pemilihan/admin/fakultas/edit/' + id_pemilihan,
                dataType: "JSON",
                data: {
                    
                },
                success: function(data) {
                    $('#edit_pemilihan_form')[0].reset();
                    $("#sub_btn").val("update");
                    $('#edit_pemilihan_id').val(data[0].id);
                    $("#nama_pemilihan").val(data[0].nama);
                    $("#tanggal_mulai").val(data[0].tanggal_mulai);
                    $("#tanggal_selesai").val(data[0].tanggal_selesai);
                    $("#nama_admin").val(data[0].nama_admin);
                    $("#npm_admin").val(data[0].npm_admin);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
            $("#modal_pemilihan").modal('open');
        }else if(role == "admin pemilihan"){
            $.ajax({
                type: "GET",
                url: '/pemilihan/admin/pemilihan/edit',
                dataType: "JSON",
                data: {
                    'id' : id_pemilihan
                },
                success: function(data) {
                    $('#edit_pemilihan_form')[0].reset();
                    $("#sub_btn").val("update");
                    $('#edit_pemilihan_id').val(data[0].id);
                    $("#edit_nama_pemilihan").val(data[0].nama);
                    $("#edit_tanggal_mulai").val(data[0].tanggal_mulai);
                    $("#edit_tanggal_selesai").val(data[0].tanggal_selesai);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

            $("#modal_edit_pemilihan").modal('open');
        }
    });
});