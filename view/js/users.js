$(".tabla").on("click", ".btnUpdateUser", function(){

	const userId = $(this).attr("userId");
	const data = new FormData();
    const option = $("#option").val();
	
    data.append("id", userId);
    data.append("option", option);

	$.ajax({

		url:"ajax/usersAjax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){

            console.log(response);
			
			$("#up_tipoid").html(response["tipoid"]);
			$("#up_tipoid").val(response["tipoid"]);
			$("#up_id").val(response["id"]);
			$("#up_name").val(response["name"]);
			$("#up_lastname").val(response["lastname"]);
			$("#up_email").val(response["email"]);
			$("#up_username").val(response["username"]);
			$("#actual_passsword").val(response["password"]);

		}

	});

});


$(".tabla").on("click", ".btnSetRole", function(){

	const userId = $(this).attr("userId");
	const role = $(this).attr("role");
	const option = $(this).attr("option");

	const data = new FormData();
 	data.append("id", userId);
  	data.append("role", role);
  	data.append("option", option);

  	$.ajax({

	  url:"ajax/usersAjax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(response){
        console.log(response);

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

  	if(role == 2){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Informes');
  		$(this).attr('role',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Administrador');
  		$(this).attr('role',2);

  	}

})