getAsistants();

function showTableAsistant(response) {
    $("#assistantsTable").dataTable().fnDestroy();
    $('#assistantsTable').DataTable({
        data: response,
        columns: [
            { data: "num" },
            { data: "assistant_id" },
            { data: "btn" }
        ]
    });

}


$("#assistantsTable").on("click", ".btnDeleteAssistant", function () {

    const id = $(this).attr("assistantId");
    const data = new FormData();
    const option = "deleteAssistant";

    data.append("id", id);
    data.append("option", option);

    swal({
        title: '¿Está seguro de eliminar el asistente?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar asistente!'
    }).then(function (result) {

        if (result.value) {

            $.ajax({

                url: "ajax/assistantsAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    getAsistants();
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

function getAsistants() {
    const data = new FormData();
    const option = "getAssistants";

    data.append("option", option);
    $.ajax({

        url: "ajax/assistantsAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            console.log(response);
            showTableAsistant(response);

        }

    });
}

function createAssistant() {
    const data = new FormData();
    const new_assistant_id = $("#new_assistant_id").prop('value');
    const new_acta_id_a = $("#new_acta_id_a").val();
    const option = "createAssistant";

    data.append("new_assistant_id", new_assistant_id);
    data.append("new_acta_id_a", new_acta_id_a);
    data.append("option", option);
    $.ajax({

        url: "ajax/assistantsAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            console.log(response);
            getAsistants();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            });
        }

    });
}
