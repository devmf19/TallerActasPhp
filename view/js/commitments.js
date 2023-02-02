getCommitments();

function showTableCommitments(response) {
    $("#commitmentsTable").dataTable().fnDestroy();
    $('#commitmentsTable').DataTable({
        data: response,
        columns: [
            { data: "num" },
            { data: "description" },
            { data: "in_charge" },
            { data: "start_date" },
            { data: "end_date" },
            { data: "btn" }
        ]
    });
}

$("#commitmentsTable").on("click", ".btnDeleteCommitment", function () {

    const commitmentId = $(this).attr("commitmentId");
    const data = new FormData();
    const option = "deleteCommitment";

    data.append("id", commitmentId);
    data.append("option", option);

    swal({
        title: '¿Está seguro de eliminar el compromiso?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar compromiso!'
    }).then(function (result) {

        if (result.value) {

            $.ajax({

                url: "ajax/commitmentsAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    getCommitments();
                    swal({
                        type: response.state,
                        title: response.msg,
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });

                }

            });

        }
    })
});

function getCommitments() {
    const data = new FormData();
    const option = "getCommitments";

    data.append("option", option);
    $.ajax({

        url: "ajax/commitmentsAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            console.log(response);
            showTableCommitments(response);

        }

    });
}

function createCommitment() {
    const data = new FormData();
    const new_in_charge_c = $("#new_in_charge_c").prop('value');
    const new_description_c = $("#new_description_c").val();
    const new_acta_id_c = $("#new_acta_id_c").val();
    const new_start_date_c = $("#new_start_date_c").val();
    const new_end_date_c = $("#new_end_date_c").val();
    const option = "createCommitment";

    data.append("new_in_charge_c", new_in_charge_c);
    data.append("new_description_c", new_description_c);
    data.append("new_acta_id_c", new_acta_id_c);
    data.append("new_start_date_c", new_start_date_c);
    data.append("new_end_date_c", new_end_date_c);
    data.append("option", option);
    $.ajax({

        url: "ajax/commitmentsAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            console.log(response);
            getCommitments();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            });
        }

    });
}