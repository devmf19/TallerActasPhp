<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Informes
    </h1>

  </section>

  <!-- Contenido principal -->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-tittle">Tipo de informe</h3>
        <select class="form-control input-lg" id="report-type">
          <option value="">Seleccione el tipo de informe que desea ver</option>
          <option value="1">Por fecha</option>
          <option value="2">Por compromiso pendiente</option>
          <option value="3">Por creador</option>
          <option value="4">Por código de acta</option>
          <option value="5">Por asunto asunto de acta</option>
        </select>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewActa"> Nueva acta</button> -->
      </div>

      <div class="box-body">

        <div id="report-field">

        </div>

        <table class="table table-bordered table-striped dt-responsive" id="reportsTable">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Creador</th>
              <th>Asunto</th>
              <th>Fecha</th>
              <th>Inicia</th>
              <th>Termina</th>
              <th>Responsable</th>
              <th>Opciones</th>
            </tr>
          </thead>


        </table>

      </div>

    </div>

  </section>

</div>