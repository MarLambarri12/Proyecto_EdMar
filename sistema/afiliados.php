<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}

include '../dependencias.php';
include '../Vistas/MenuAdmin.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logosinfondo.png" />
        <link rel="stylesheet" href="../codigo/css/modal.css">
        <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/alertifyjs/css/alertify.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../bootstrap/js/jquery-3.7.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../bootstrap/alertifyjs/alertify.js"></script>
        <title>Afiliados</title>
    </head>
    <body style="background-color: #00adc9">
    <div class="container-fluid">
    <br>
    <div align="right"><button type="button" data-bs-toggle="modal" data-bs-target="#EmpresaModal" class="btn btn-success" id="btnU">Nueva Empresa</button></div>
    <br>    
    <div class="row g-0 text-center">
            <!-- Inicia la primera columna -->
            <div class="col-sm-6 col-md-8">
                <div class="card" style="width: 150%;">
                    <div class="card-header d-flex justify-content-start" style="background-color:#ffc107">
        <h4>Empresas Afiliadas</h4>
</div>
        <div id="tablaEmpresaLoad" class="card-body table-responsive">
        </div>
        </di>
  </div>


<!-- Modal Agregar -->
<div class="modal fade" id="EmpresaModal" tabindex="-1" aria-labelledby="EmpresaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EmpresaModalLabel">Agregar Nueva Empresa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formEmpresaNew" enctype="multipart/form-data">
  <div class="row mb-3">
    <div class="col">
      <label for="nombre" class="form-label">Nombre de la Empresa</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col">
      <label for="RFC" class="form-label">RFC</label>
      <input type="text" class="form-control" id="rfc" name="rfc" required>
    </div>
    <div class="col">
        <label for="RFC" class="form-label">Telefono</label>
        <input type="text" class="form-control" id="tel" name="tel" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <label for="Email" class="form-label">Correo Electronico</label>
      <input type="text" class="form-control" id="email" name="email" required>
    </div>
  </div>

  <div class="row mb-3">
        <div class="col">
          <label for="localizacion" class="form-label">Localización</label>
          <textarea class="form-control" id="loc" name="loc" rows="2" required></textarea>
        </div>
  </div>      
  <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnAgregar" data-bs-dismiss="modal">Guardar</button>
      </div>
</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="EmpresaEditModal" tabindex="-1" aria-labelledby="EmpresaEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EmpresaModalLabel">Editar Datos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formEmpresaEdit" enctype="multipart/form-data">
      <input type="text" id="id" hidden name="id">
  <div class="row mb-3">
    <div class="col">
      <label for="nombreE" class="form-label">Nombre de la Empresa</label>
      <input type="text" class="form-control" id="nombreE" name="nombreE" required>
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col">
      <label for="RFCe" class="form-label">RFC</label>
      <input type="text" class="form-control" id="rfcE" name="rfcE" required>
    </div>
    <div class="col">
        <label for="tel" class="form-label">Telefono</label>
        <input type="text" class="form-control" id="telE" name="telE" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <label for="EmailE" class="form-label">Correo Electronico</label>
      <input type="text" class="form-control" id="emailE" name="emailE" required>
    </div>
  </div>

  <div class="row mb-3">
        <div class="col">
          <label for="localizacionE" class="form-label">Localización</label>
          <textarea class="form-control" id="locE" name="locE" rows="2" required></textarea>
        </div>
  </div>      
  <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnActualiza" data-bs-dismiss="modal">Actualizar</button>
      </div>
</form>
      </div>
    </div>
  </div>
</div>
    </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
			$('#tablaEmpresaLoad').load("Afiliados/TEmpresas.php");

            $('#btnU').click(function() {
				document.forms.namedItem("formEmpresaNew").reset();
			});

            $('#btnAgregar').click(function(){
                datos=$('#formEmpresaNew').serialize();
                    $.ajax({
                        type:"POST",
                        data:datos,
                        url:"../procesos/Afiliados/agregaEmpresa.php",
                        success:function(r){
                        if(r==1){
                            $('#tablaEmpresaLoad').load("Afiliados/TEmpresas.php");
                            alertify.success("Dato agregado correctamente");
                        }else{
                            alertify.error("Error al agregar");
                        }
            }
        });
    });

             $('#btnActualiza').click(function(){
                datos=$('#formEmpresaEdit').serialize();
                    $.ajax({
                        type:"POST",
                        data:datos,
                        url:"../procesos/Afiliados/actualizaEmpresa.php",
                        success:function(r){
                        if(r==1){
                            $('#tablaEmpresaLoad').load("Afiliados/TEmpresas.php");
                            alertify.success("Actualizado Correctamente");
                        }else{
                            alertify.error("Error");
                        }
            }
        });
    });
});

    function eliminaEmpresa(id){
		alertify.confirm('¿Desea eliminar esta Empresa?', function(){ 
				$.ajax({
					type:"POST",
					data:"idempresa=" + id,
					url:"../procesos/Afiliados/EliminaEmpresa.php",
					success:function(r){
						if(r==1){
							$('#tablaEmpresaLoad').load("Afiliados/TEmpresas.php");
							alertify.success("Se eliminó el dato correctamente");
						}else{
							alertify.error("No se realizó la acción");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado')
			});
	}

    function editarEmpresa(id){
			$.ajax({
				type:"POST",
				data:"id=" + id,
				url:"../procesos/Afiliados/datosEmpresa.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#id').val(dato['id']);
					$('#nombreE').val(dato['nombreEmpresa']);
					$('#rfcE').val(dato['RFC']);
					$('#telE').val(dato['Telefono']);
					$('#emailE').val(dato['Email']);
					$('#locE').val(dato['Loc']);
				}
			});
		}

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-+:";
        especiales = [8, 37, 39, 46];

        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }
</script>