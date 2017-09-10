$(document).ready(function() {
	$("#add_candidate_form").submit(function(e) {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $("meta[name='_token'").attr("content")
			}
		});
		e.preventDefault();

		var formData_ = new FormData($(this)[0]);
		var state = $("#submit_btn").val();
		var candidate_number = $("#candidate_number").val();

		if(state == "add") {
			$.ajax({
				url: "/kandidat/store/" + candidate_id,
				processData: false,
				contentType: false,
				type"POST",
				data: formData_,
				dataType: "JSON",
				success: function(data) {
					getCandidate(candidate_id);
					Materialize.toast("Kandidat Berhasil Ditambahkan!", 2000);
					$("#modal-candidate").modal('close');
				},
				error:function(data) {
					Materialize.toast("Kandidat Gagal Ditambahkan!", 2000);
				}
			});
		}

		if(state == "update") {
			$.ajax({
				url: "/kandidat/store/" + candidate_id + '/' + candidate_number,
				processData: false,
				contentType: false,
				type"POST",
				data: formData_,
				dataType: "JSON",
				success: function(data) {
					getCandidate(candidate_id);
					Materialize.toast("Kandidat Berhasil Diubah!", 2000);
					$("#modal-candidate").modal('close');
				},
				error:function(data) {
					Materialize.toast("Kandidat Gagal Diubah!", 2000);
				}
			});
		}
	});

	$('#add_candidate').click(function() {
        $('#add_candidate_form')[0].reset();
        $("#candidate_number").val(candidate_number);
    });

	function getCandidate(candidate_id) {
		$.ajax({
			url: '/kandidat/findByElection',
			type: "GET",
			dataType: "JSON",
			data: {
				'id' : candidate_id
			},

			success: function(data) {
				var table = $("#candidate_table");
				var thead = table.find("thead");
				var tbody = table.find("tbody");
				tbody.empty();

				if(data.length < 1) {
					candidate_number = 1;
				} else {
					candidate_number - data[data.length - 1].no_urut + 1;
				}

				$("#candidate_number").val(candidate_number);

				for (var i = 0; i < data.length; i++) {
					var candidateList = "<tr>";
					candidateList += "<td>" + data[i].no_urut + "</td>";
					candidateList += "<td>" + "<img src='images/candidates/" + data[i].path_foto_ketua + "'" + "height='180' width='180'>";

					if(data[i].nama_wakil != null) {
						candidateList += "<img src = 'images/candidates/" + data[i].path_foto_wakil + "'" + "height= '180' width='180'>";
					}

					candidateList += "</td>";
					candidateList += "<td>" + data[i].nama_ketua + "<br>";

					if(data[i].nama_wakil != null) {
						candidateList += data[i].nama_wakil;
					}					

					candidateList += "</td>";

					candidateList += '<td><button value="' + data[i].no_urut + '"' +
                        ' class="btn-floating medium brown edit_candidate"><i class="material-icons left" value="' + data[i].candidate_number + '">edit</i></button>' +
                        '</td>' +
                        '<td>' +
                        '<button value="' + data[i].no_urut + '"' +
                        ' onclick="return confirm("Are you sure you want to delete this candidate?")"' +
                        ' class="btn-floating medium  teal lighten-1 delete_candidate"><i class="material-icons">delete</i></button>' +
                        '</td>';
                    candidateList += "</tr>";	

                    tbody.append(candidateList);
				}

				$("#loader").css("display", "none");
                $("#result").css("display", "block");   
			},
			error: function(err) {
				console.log("get candidates error");
			}

		});
	}
});