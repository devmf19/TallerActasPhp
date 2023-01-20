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
