// $(document).ready(function () {
//     $('form').submit(function (e) {
//         e.preventDefault();
//     });
// });

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3500);


// $("#btnLogin").click(function (e) {
//     const username = $("#username").val();
//     const pasword = $("#password").val();

//     const data = new FormData();
//     data.append('option', "login");
//     data.append('username', username);
//     data.append('password', pasword);


//     $.ajax({
//         url: "ajax/usersAjax.php",
//         method: "POST",
//         data: data,
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function (response) {

//         }
//     });

//     fetch("ajax/usersAjax.php", {
//         method: "POST",
//         body: data
//     });

// });


// function alert(ty, ti) {
//     swal({
//         type: ty,
//         title: ti,
//         showConfirmButton: true,
//         confirmButtonText: "Cerrar"
//     });
// }