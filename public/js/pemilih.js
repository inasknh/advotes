$(document).ready(function() {
	var id_pemilihan = $("#select_pemilihan").val();
	var state;
	// $('#pemilihTable').DataTable(getPemilih());
    getPemilihDataTable();

    $("#select_pemilihan").change(function(){
        id_pemilihan = $("#select_pemilihan").val();
        console.log("pemilihan selected " + id_pemilihan )
        // getPemilih();
        $('#pemilihTable').DataTable().destroy();
        getPemilihDataTable();
    });

    function getPemilihDataTable(){
        $('#pemilihTable').DataTable({
        processing : true,
        serverSide : true,
        responsive : true,
        ajax: '/pemilih/list/' + id_pemilihan,
        columns : [
            {data : 'nama', name :'nama'},
            {data : 'npm', name : 'npm'},
            {data : 'id', name : 'id', sortable : false,
                render : function (data, type, full){
                    return '<button value="' + data + '"' +
                        'id="edit_pemilih_id" class="waves-effect waves-light btn blue-grey darken-4 edit_pemilih">' +
                        '<i class="material-icons" value="' + data + '">edit</i></button>';
                }
            },
            {data : 'id', name : 'id', sortable : false,
                render : function(data, type, full){
                    return '<button value="' + data + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus DPT ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_pemilih">'+
                        '<i class="material-icons">delete</i></button>';
                }

            }
        ]

    });
    }


	function getPemilih() {
        console.log("id_pemilihan " + id_pemilihan);
        console.log("masuk get");
        $.ajax({
            type: "GET",
            url: '/pemilih/list/' + id_pemilihan,
            dataType: "JSON",
            data:{

            } ,
            success: function(data) {
                var table = $("#pemilihTable");
                var thead = table.find("thead");
                var tbody = table.find("tbody");
                tbody.empty();

                var tableHead = "<tr>"+
                            "<th>No </th>"+
                            "<th>Nama</th>"+
                            "<th>NPM</th>"+
                            "<th>Ubah</th>"+
                            "<th>Hapus</th>"+
                        "</tr>";


                if (data.length < 1) {
                    thead.text("Anda belum memiliki pemilih");
                }
                else {
                    thead.text("");
                    thead.append(tableHead);
                    for (var i = 0; i < data.length; i++) {
                        var pemilihList = "<tr>";
                        pemilihList += "<td>" + (i + 1) + "</td>";
                        pemilihList += "<td>" + data[i].nama + "</td>";
                        pemilihList += "<td>" + data[i].npm + "</td>";
                        pemilihList += '<td><button value="' + data[i].id + '"' +
                        'id="edit_pemilih_id" class="waves-effect waves-light btn blue-grey darken-4 edit_pemilih"><i class="material-icons" value="' + data[i].id + '">edit</i></button>' +
                        '</td>' +
                        '<td>' +
                        '<button value="' + data[i].id + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus pemilih ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_pemilih"><i class="material-icons">delete</i></button>' +
                        '</td>';
                        pemilihList += "</tr>";
                        tbody.append(pemilihList);
                    }

                }
                $("#loader").css("display", "none");
                $("#result").css("display", "block");
            },
            error: function(err) {
                console.log("get pemilih error");
            }
        });
    }

    $('.add_pemilih').click(function() {
			$("#modal-title").text("Tambah Pemilih");
        state = $("#sub_btn").val();
        $('#add_pemilih_form')[0].reset();
        $('#add_excel_pemilih_form')[0].reset();
    });


     $("#add_excel_pemilih_form").submit(function(e){
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state = 'addExcel';
        $idPemilih = $("#edit_pemilih_id").val();
        $nama = $('#nama_pemilih').val();
        $npm = $('#npm_pemilih').val();
        console.log(state + " state");
        console.log($idPemilih +" sebelum if");

        if(state == "addExcel"){
            $.ajax({
                url:"/pemilih/importExcel/" + id_pemilihan,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    // getPemilih();
                    $('#pemilihTable').DataTable().destroy();
                    getPemilihDataTable();
                    Materialize.toast('Data DPT Berhasil Ditambahkan!', 2000);
                    $("#modal_pemilih").modal('close');
                },
                error: function(err) {
                    console.log("get pemilih error");
                    Materialize.toast('Data DPT Gagal Ditambahkan!', 2000);
                }
            });
        }
    });

    $("#add_pemilih_form").submit(function(e){
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state = $("#sub_btn").val();
        $idPemilih = $("#edit_pemilih_id").val();
        $nama = $('#nama_pemilih').val();
        $npm = $('#npm_pemilih').val();
        console.log(state + " state");
        console.log($idPemilih +" sebelum if");

        if(state == "add") {
            $.ajax({
                url:"/pemilih/store/" + id_pemilihan,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    // getPemilih();
                    $('#pemilihTable').DataTable().destroy();
                    getPemilihDataTable();
                    Materialize.toast('Data DPT Berhasil Ditambahkan!', 2000);
                    $("#modal_pemilih").modal('close');
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.npm){
                        Materialize.toast('Data DPT Gagal Ditambahkan. ERROR: ' + $errors.npm, 3000);
                    }
                    if($errors.nama){
                        Materialize.toast('Data DPT Gagal Ditambahkan. ERROR: ' + $errors.nama, 3000);
                    }

                }

            });
        }
        if(state == "update") {
            console.log($idPemilih + " id_pemilih di update");
            $.ajax({
                url:'/pemilih/update/' + $idPemilih,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",
                success: function(data) {
                    // getPemilih();
                    $('#pemilihTable').DataTable().destroy();
                    getPemilihDataTable();
                    Materialize.toast('Data DPT Berhasil Diubah', 2000);
                    $("#modal_pemilih").modal("close");
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    Materialize.toast('Data DPT Gagal Dihapus. ERROR: ' + $errors.npm, 3000);
                }
            });
        }
    });

     $(document).on('click', '.delete_pemilih', function(e) {
        if(confirm('Are you sure you want to delete this?')){
            var id = $(this).val();
            var id_pemilihan = $('#select_pemilihan').val();
          //  console.log(id_penjaga);
            $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();


            $.ajax({
                type: "POST",
                url: '/pemilih/delete/',
                data: {
                    'id' : id,
                    'idPemilihan' : id_pemilihan
                },
                success: function(data) {
                    $('#pemilihTable').DataTable().destroy();
                    getPemilihDataTable();
                    Materialize.toast('Data DPT Berhasil Dihapus!', 2000);
                    // getPemilih();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Materialize.toast('Data DPT Gagal Dihapus!', 2000);
                }
            });
        }
    });

    $(document).on('click', '.edit_pemilih', function() {
				$("#modal-title").text("Edit Pemilih");
        var id_pemilih = $(this).val();
        console.log("id Pemilih " + id_pemilih);
        $.ajax({
            type: "GET",
            url: '/pemilih/edit',
            dataType: "JSON",
            data: {
                'id' : id_pemilih
            },
            success: function(data) {
                $('#add_pemilih_form')[0].reset();
                $("#sub_btn").val("update");
                $('#edit_pemilih_id').val(data[0].id);
                $("#npm_pemilih").val(data[0].npm);
                $("#nama_pemilih").val(data[0].nama);
            },
            error: function(data) {}
        });
        $("#modal_pemilih").modal('open');
    });

});
