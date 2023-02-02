function showTableAsistant(response) {
    if (response.num == '') {
        swal({
            type: "error",
            title: "Sin resultados",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        })
    }
    $("#assistantsTable").dataTable().fnDestroy();
    $('#assistantsTable').DataTable({
        data: response,
        columns: [
            { data: "num" },
            { data: "issue" },
            { data: "creator_id" },
            { data: "created_date" },
            { data: "start_time" },
            { data: "end_time" },
            { data: "in_charge" },
            { data: "btn" }
        ]
    });

}


$(".tabla").on("click", ".btnDeleteAssistant", function () {

    var id = $(this).attr("id");

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

            window.location = "index.php?route=assistants&id_assistant=" + id;

        }
    })
})
