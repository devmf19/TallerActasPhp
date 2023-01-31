
function mostrar() {
    const data = new FormData();
    const option = "getPending";

    data.append("option", option);

    //$(document).ready(function() {
        $('#reportsTable').DataTable( {
          "ajax":{
              "url": "ajax/actasAjax.php",
              "method": "POST",
              "data": {'opcion': data},
              "dataSrc":""
          },
          "columns":[
              {"data": "issue"},
              {"data": "issue"},
              {"data": "creator_id"},
              {"data": "created_date"},
              {"data": "start_time"},
              {"data": "end_time"},
              {"data": "in_charge"},
              {"data": "issue"}
          ]  
        });
    //});

    
}

$('#report-type').on('change', function () {
    const option = $(this).prop('value');
    document.getElementById('report-field').innerHTML = '';
    console.log(option);
    if (option == 1) {
        dates();
    } else if (option == 2) {
        // mostrar();
        getPending();
    } else if (option == 3) {
        getUsers();
    } else if (option == 4) {
        idActas();
    } else if (option == 5) {
        issueActas();
    }
});


function getBetween() {
    const data = new FormData();
    const initialDate = $("#initial-date").val();
    const endDate = $("#end-date").val();
    const option = "getBetween";

    data.append("initialDate", initialDate);
    data.append("endDate", endDate);
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

        }

    });
}

function getPending() {
    const data = new FormData();
    const option = "getPending";

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
            //response = JSON.parse(response);
            console.log(response);
            $("#reportsTable").dataTable().fnDestroy();
            $('#reportsTable').DataTable( {
                data: response,
                columns:[
                    {data: "num"},
                    {data: "issue"},
                    {data: "creator_id"},
                    {data: "created_date"},
                    {data: "start_time"},
                    {data: "end_time"},
                    {data: "in_charge"},
                    {data: "btn"}
                ]  
              });
        }

    });
}

function getByActa() {
    const data = new FormData();
    const id = $("#id-acta").val();
    const option = "getByActa";

    data.append("id", id);
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

        }

    });
}

function getByIssue() {
    const data = new FormData();
    const issue = $("#issue-acta").val();
    const option = "getByIssue";

    data.append("issue", issue);
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

        }

    });
}
function getByCreator() {
    const data = new FormData();
    const creatorId = $("#users-report").val();
    const option = "getByCreator";

    data.append("creatorId", creatorId);
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

        }

    });
}

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

            console.log(response);
            users(response);

        }

    });
}



function dates() {
    document.getElementById('report-field').innerHTML = '' +
        '<div class="form-group row">' +

        '<div class="col-xs-5">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">Desde</span>' +
        '<input type="date" class="form-control input-lg" id="initial-date" name="initial-date" required>' +
        '</div>' +
        '</div>' +

        '<div class="col-xs-5">' +
        '<div class="input-group">' +
        '<input type="date" class="form-control input-lg" id="end-date" name="end-date" required>' +
        '<span class="input-group-addon">Hasta</span>' +
        '</div>' +
        '</div>' +

        '<div class="col-xs-2">' +
        '<div class="input-group">' +
        '<button class="btn btn-primary btn-lg" id="date-report" onclick="getBetween()">Buscar</button>' +
        '</div>' +
        '</div>' +

        '</div>'
        ;
}

function idActas() {
    document.getElementById('report-field').innerHTML = '' +
        '<div class="form-group row">' +

        '<div class="col-xs-10">' +
        '<div class="input-group">' +
        '<input type="number" class="form-control input-lg" id="id-acta" name="id-acta" placeholder="Código" required>' +
        '</div>' +
        '</div>' +

        '<div class="col-xs-2">' +
        '<div class="input-group">' +
        '<button class="btn btn-primary btn-lg" id="acta-report1" onclick="getByActa()">Buscar</button>' +
        '</div>' +
        '</div>' +

        '</div>'
        ;
}

function issueActas() {
    document.getElementById('report-field').innerHTML = '' +
        '<div class="form-group row">' +

        '<div class="col-xs-10">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control input-lg" id="issue-acta" name="issue-acta" placeholder="Asunto" required>' +
        '</div>' +
        '</div>' +

        '<div class="col-xs-2">' +
        '<div class="input-group">' +
        '<button class="btn btn-primary btn-lg" id="acta-report1" onclick="getByIssue()">Buscar</button>' +
        '</div>' +
        '</div>' +

        '</div>'

        ;
}
function users(json) {
    document.getElementById('report-field').innerHTML = '' +
        '<div class="form-group">' +
        '<div class="col-xs-10">' +
        '<div class="input-group">' +

        '<select class="form-control input-lg" id="users-report" name="users-report" required>' +
        '<option value="">Creador del acta</option>';
    $.each(json, function (id, name) {
        $('#users-report').append('<option value=' + name.id + '>' + name.name + '</option>');
    });
    $("#report-field").append('</select>' +

        '</div>' +
        '</div>' +

        '<div class="col-xs-2">' +
        '<div class="input-group">' +
        '<button class="btn btn-primary btn-lg" id="acta-report1" onclick="getByCreator()">Buscar</button>' +
        '</div>' +
        '</div>' +

        '</div >')
        ;
}



