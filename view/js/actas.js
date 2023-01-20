$(".tabla").on("click", ".btnEditActa", function () {
    const id = $(this).attr("id");
    const form = new FormData();
    form.append("id_acta", id);
    
    $.ajax({

        url: "ajax/actasAjax.php",
        method: "POST",
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (rta) {
            console.log("respuesta", rta);
            $("#id_acta").val(rta["id"]);
            $("#up_creator_id").val(rta["creator_id"]);
            $("#up_issue").val(rta["issue"]);
            $("#up_start_time").val(rta["start_time"]);
            $("#up_end_time").val(rta["end_time"]);
            $("#up_in_charge").val(rta["in_charge"]);
            $("#up_order_of_day").val(rta["order_of_day"]);
            $("#up_facts_description").val(rta["facts_description"]);

        } 

    });

    
})

$(".tabla").on("click", ".btnDeleteActa", function () {

    var id = $(this).attr("id");

    swal({
        title: '¿Está seguro de eliminar el acta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar acta!'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?route=actas&id_acta=" + id;

        }
    })
})
