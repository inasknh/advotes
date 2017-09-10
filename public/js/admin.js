$(document).ready(function() {
	var id_admin;
	var state;
	// $('#adminTable').DataTable(getAdmin());
    getAdminDataTable();

     function getAdminDataTable(){
        $('#adminTable').DataTable({
        processing : true,
        serverSide : true,
        responsive : true,
        ajax: '/admin/list',
        columns : [
            {data : 'username', name :'username'},
            {data : 'npm', name : 'npm'},
            {data : 'fakultas_name', name : 'fakultas_name'},
            {data : 'pemilihan_name', name : 'pemilihan_name'},
            {data : 'id_admin', name : 'id_admin', sortable : false,
                render : function (data, type, full){
                    return '<button value="' + data + '"' +
                        'id="edit_admin_id" class="waves-effect waves-light btn blue-grey darken-4 edit_admin">' +
                        '<i class="material-icons" value="' + data + '">edit</i></button>';
                }
            },
            {data : 'id_admin', name : 'id_admin', sortable : false,
                render : function(data, type, full){
                    return '<button value="' + data + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus DPT ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_admin">'+
                        '<i class="material-icons">delete</i></button>';
                }

            }
        ]});
    }
	function getAdmin() {
        console.log("masuk get");
        $.ajax({
            type: "GET",
            url: '/admin/list',
            dataType: "JSON",
            data:{} ,
            success: function(data) {
                var table = $("#adminTable");
                var thead = table.find("thead");
                var tbody = table.find("tbody");
                tbody.empty();

                var tableHead = "<tr>"+
                            "<th>No </th>"+
                            "<th>Nama</th>"+
                            "<th>NPM</th>"+
                            "<th>Fakultas</th>"+
                            "<th>Pemilihan</th>"+
                            "<th>Ubah</th>"+
                            "<th>Hapus</th>"+
                        "</tr>";


                if (data.length < 1) {
                    thead.text("Anda belum memiliki admin");
                }
                else {
                    thead.text("");
                    thead.append(tableHead);
                    for (var i = 0; i < data.length; i++) {
                        var adminList = "<tr>";
                        adminList += "<td>" + (i + 1) + "</td>";
                        adminList += "<td>" + data[i].username + "</td>";
                        adminList += "<td>" + data[i].npm + "</td>";
                        adminList += "<td>" + data[i].fakultas_name + "</td>";
                        adminList += "<td>" + data[i].pemilihan_name + "</td>";
                        adminList += '<td><button value="' + data[i].id_admin + '"' +
                        'id="edit_admin_id" class="waves-effect waves-light btn blue-grey darken-4 edit_admin"><i class="material-icons" value="' + data[i].id_admin + '">edit</i></button>' +
                        '</td>';
                        adminList += '<td><button value="' + data[i].id_admin + '"' +
                        ' onclick="return confirm("Apakah kamu yakin ingin menghapus admin ini?")"' +
                        ' class="waves-effect waves-light btn blue-grey darken-4 delete_admin"><i class="material-icons">delete</i></button>' +
                        '</td>';
                        adminList += "</tr>";
                        tbody.append(adminList);
                    }

                }
                $("#loader").css("display", "none");
                $("#result").css("display", "block");
            },
            error: function(err) {
                console.log("get admin error");
            }
        });
    }

    $('.add_admin').click(function() {
				$("#modal-title").text("Tambah Admin");
        state = $("#sub_btn").val("add");
        $('#add_admin_form')[0].reset();
    });


    $("#add_admin_form").submit(function(e){
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var formData_ = new FormData($(this)[0]);
        state = $("#sub_btn").val();
        $idAdmin = $("#edit_admin_id").val();
        $nama = $('#username_admin').val();
        $npm = $('#npm_admin').val();
        console.log($idAdmin +" sebelum if");

        if(state == "addAdmin") {
            $.ajax({
                url:"/admin/store/",
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",

                success: function(data) {
                    // getAdmin();
                    $('#adminTable').DataTable().destroy();
                    getAdminDataTable();
                    Materialize.toast('Admin Berhasil Ditambahkan!', 2000);
                    $("#modal_admin").modal('close');
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.npm){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.npm, 4000);
                    }
                    if($errors.username){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.username, 4000);
                    }
                    if($errors.fakultas){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.fakultas, 4000);
                    }
                }

            });
        }
        if(state == "update") {
            console.log($idAdmin + " id_Admin di update");
            $.ajax({
                url:'/admin/update/' + $idAdmin,
                processData: false,
                contentType: false,
                type: "POST",
                data: formData_,
                dataType: "JSON",
                success: function(data) {
                    $('#adminTable').DataTable().destroy();
                    getAdminDataTable();
                    Materialize.toast('Admin Berhasil Diubah', 2000);
                    $("#modal_admin").modal("close");
                    // getAdmin();
                },
                error: function(xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    $errors = responseJSON;
                    if($errors.npm){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.npm.unique, 4000);
                    }
                    if($errors.username){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.username, 4000);
                    }
                    if($errors.fakultas){
                        Materialize.toast('Admin Gagal Ditambahkan. ERROR: ' + $errors.fakultas, 4000);
                    }
                }
            });
        }
    });

     $(document).on('click', '.delete_admin', function(e) {
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
                url: '/admin/delete/' + id,
                data: {
                    'id' : id
                },
                success: function(data) {
                    $('#adminTable').DataTable().destroy();
                    getAdminDataTable();
                    Materialize.toast('Admin Berhasil Dihapus!', 2000);
                    // getAdmin();
                },
                error: function(data) {
                    console.log('Error:', data);
                    Materialize.toast('Admin Gagal Dihapus!', 2000);
                }
            });
        }
    });

    $(document).on('click', '.edit_admin', function() {
				$("#modal-title").text("Edit Admin");
        var id_admin = $(this).val();
        console.log("id admin " + id_admin);
        $.ajax({
            type: "GET",
            url: '/admin/edit',
            dataType: "JSON",
            data: {
                'id' : id_admin
            },
            success: function(data) {
                $('#add_admin_form')[0].reset();
                $("#sub_btn").val("update");
                $('#edit_admin_id').val(data[0].id);
                $("#npm_admin").val(data[0].npm);
                $("#username_admin").val(data[0].username);
            },
            error: function(data) {}
        });
        $("#modal_admin").modal('open');
    });

});
