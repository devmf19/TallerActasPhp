getUsers();

function showTableUser(response) {
    $("#usersTable").dataTable().fnDestroy();
    $('#usersTable').DataTable({
        data: response,
        columns: [
            { data: "num" },
            { data: "id" },
            { data: "tipoid" },
            { data: "name" },
            { data: "username" },
            { data: "role" },
            { data: "btn" }
        ]
    });
}

$("#usersTable").on("click", ".btnUpdateUser", function () {

    const userId = $(this).attr("userId");
    const data = new FormData();
    const option = "getUser";

    data.append("id", userId);
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

            console.log(response);
            if (response["tipoid"] == 1) {
                $("#up_tipoid").html("Cédula de ciudadanía");
            } else {
                $("#up_tipoid").html("Tarjeta de identidad");
            }
            if (response["role"] == 1) {
                $("#up_role").html("Informes");
            } else {
                $("#up_role").html("Administrador");
            }

            $("#up_tipoid").val(response["tipoid"]);
            $("#up_role").val(response["role"]);
            $("#up_id").val(response["id"]);
            $("#up_name").val(response["name"]);
            $("#up_lastname").val(response["lastname"]);
            $("#up_email").val(response["email"]);
            $("#up_username").val(response["username"]);
            $("#actual_passsword").val(response["password"]);

        }

    });

});

$("#usersTable").on("click", ".btnDeleteUser", function () {

    const userId = $(this).attr("userId");
    const data = new FormData();
    const option = "deleteUser";

    data.append("id", userId);
    data.append("option", option);

    swal({
        title: '¿Está seguro de eliminar el usuario?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function (result) {

        if (result.value) {

            $.ajax({

                url: "ajax/usersAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    getUsers();
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


$("#usersTable").on("click", ".btnSetRole", function () {

    const userId = $(this).attr("userId");
    role = $(this).attr("role");
    const option = "setRole";

    const data = new FormData();
    data.append("id", userId);
    data.append("role", role);
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
            console.log(response);
            if (role == 2) {

                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
                $(this).html('Informes');
                $(this).attr('role', 1);

            } else {

                $(this).addClass('btn-success');
                $(this).removeClass('btn-danger');
                $(this).html('Administrador');
                $(this).attr('role', 2);

            }

            // if(window.matchMedia("(max-width:767px)").matches){

            // 	 swal({
            //       title: "El usuario ha sido actualizado",
            //       type: "success",
            //       confirmButtonText: "¡Cerrar!"
            //     }).then(function(result) {
            //         if (result.value) {

            //         	window.location = "users";

            //         }


            // 	});

            // }

        }

    })



});

function getUsers() {
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
            showTableUser(response);

        }

    });
}

function updateUser() {
    const data = new FormData();
    const up_tipoid = $(".up_tipoid").prop('value');
    const up_id = $("#up_id").val();
    const up_role = $(".up_role").prop('value');
    const up_name = $("#up_name").val();
    const up_lastname = $("#up_lastname").val();
    const up_email = $("#up_email").val();
    const up_username = $("#up_username").val();
    const up_password = $("#up_password").val();
    const option = "updateUser";

    data.append("up_tipoid", up_tipoid);
    data.append("up_id", up_id);
    data.append("up_role", up_role);
    data.append("up_name", up_name);
    data.append("up_lastname", up_lastname);
    data.append("up_email", up_email);
    data.append("up_username", up_username);
    data.append("up_password", up_password);
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

            console.log(response);
            getUsers();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            })

        }

    });
}

function createUser() {
    const data = new FormData();
    const new_tipoid = $("#new_tipoid").prop('value');
    const new_id = $("#new_id").val();
    const new_name = $("#new_name").val();
    const new_lastname = $("#new_lastname").val();
    const new_email = $("#new_email").val();
    const new_username = $("#new_username").val();
    const new_password = $("#new_password").val();
    const option = "signup";

    data.append("new_tipoid", new_tipoid);
    data.append("new_id", new_id);
    data.append("new_name", new_name);
    data.append("new_lastname", new_lastname);
    data.append("new_email", new_email);
    data.append("new_username", new_username);
    data.append("new_password", new_password);
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

            console.log(response);
            getUsers();
            swal({
                type: response.state,
                title: response.msg,
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            });
            if (response.state == 'success') {
                window.location = "login";
            }


        }

    });
}