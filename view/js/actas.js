getActasAll();

$("#actasTable").on("click", ".btnUpdateActa", function () {

    const actaId = $(this).attr("actaId");
    const data = new FormData();
    const option = "getByActa";

    data.append("id", actaId);
    data.append("option", option);

    $.ajax({

        url: "ajax/actasAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {



            const data = new FormData();
            const option = "getUsers";

            data.append("option", option);
            $.ajax({

                url: "ajax/usersAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    //console.log(response);
                    $.each(response, function (id, name) {

                        $('#up_creator_id').append('<option value=' + name.id + '>' + name.name + '</option>');
                        $('#up_in_charge').append('<option value=' + name.id + '>' + name.name + '</option>');
                    });

                }

            });
            console.log(response);
            $("#up_id_acta").val(response[0]["id"]);
            $("#up_issue").val(response[0]["issue"]);
            $("#up_created_date").val(response[0]["created_date"]);
            $("#up_start_time").val(response[0]["start_time"]);
            $("#up_end_time").val(response[0]["end_time"]);
            $("#up_order_of_day").val(response[0]["order_of_day"]);
            $("#up_facts_description").val(response[0]["facts_description"]);

        }

    });

});

$("#actasTable").on("click", ".btnDeleteActa", function () {

    const actaId = $(this).attr("actaId");
    const data = new FormData();
    const option = "deleteActa";

    data.append("id", actaId);
    data.append("option", option);

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

            $.ajax({

                url: "ajax/actasAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    getActasAll();
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
})

function showTableActas(response) {
    if (response.num == '') {
        swal({
            type: "error",
            title: "Sin resultados",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        })
    }
    //console.log(response);
    $("#actasTable").dataTable().fnDestroy();
    $('#actasTable').DataTable({
        data: response,
        columns: [
            { data: "num" },
            { data: "creator_id" },
            { data: "issue" },
            { data: "created_date" },
            { data: "start_time" },
            { data: "end_time" },
            { data: "in_charge" },
            { data: "btn" }
        ]
    });
}

function getActasAll() {
    const data = new FormData();
    const option = "getActas";

    data.append("option", option);
    $.ajax({

        url: "ajax/actasAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            showTableActas(response);

        }

    });
}

function crateActa() {
    const data = new FormData();
    const new_creator_id = $("#new_creator_id").prop('value');
    const new_issue = $("#new_issue").val();
    const new_created_date = $("#new_created_date").val();
    const new_start_time = $("#new_start_time").val();
    const new_end_time = $("#new_end_time").val();
    const new_in_charge = $("#new_in_charge").prop('value');
    const new_order_of_day = $("#new_order_of_day").val();
    const new_facts_description = $("#new_facts_description").val();
    const option = "createActa";

    data.append("new_creator_id", new_creator_id);
    data.append("new_issue", new_issue);
    data.append("new_created_date", new_created_date);
    data.append("new_start_time", new_start_time);
    data.append("new_end_time", new_end_time);
    data.append("new_in_charge", new_in_charge);
    data.append("new_order_of_day", new_order_of_day);
    data.append("new_facts_description", new_facts_description);
    data.append("option", option);
    $.ajax({

        url: "ajax/actasAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            //console.log(response);
            getActasAll();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            })

        }

    });

}

function updateActa() {
    const data = new FormData();
    const up_creator_id = $("#up_creator_id").prop('value');
    const up_id_acta = $("#up_id_acta").val();
    const up_issue = $("#up_issue").val();
    const up_created_date = $("#up_created_date").val();
    const up_start_time = $("#up_start_time").val();
    const up_end_time = $("#up_end_time").val();
    const up_in_charge = $("#up_in_charge").val();
    const up_order_of_day = $("#up_order_of_day").val();
    const up_facts_description = $("#up_facts_description").val();
    const option = "updateActa";

    data.append("up_creator_id", up_creator_id);
    data.append("up_id_acta", up_id_acta);
    data.append("up_issue", up_issue);
    data.append("up_created_date", up_created_date);
    data.append("up_start_time", up_start_time);
    data.append("up_end_time", up_end_time);
    data.append("up_in_charge", up_in_charge);
    data.append("up_order_of_day", up_order_of_day);
    data.append("up_facts_description", up_facts_description);
    data.append("option", option);
    $.ajax({

        url: "ajax/actasAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {

            console.log(response);
            getActasAll();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            })

        }

    });
}

