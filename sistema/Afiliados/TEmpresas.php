<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';

mysqli_query($conn,"SET NAMES 'utf8'");

$sql = "SELECT id_empresa, nombre_empresa, RFC, Localizacion, Email, Telefono FROM `empresas_afi`";
$result = $conn->query($sql);
?>

<body>
<table class="table table-light table-sm table-hover table-condensed table-bordered" style="text-align: center;">
	<thead class="table-dark">
    <tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>RFC</th>
		<th>Localización</th>
		<th>Correo Electronico</th>
		<th>Telefono</th>
		<th>Editar Datos</th>
		<th>Eliminar de la Lista</th>
	</tr>
    </thead>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td>
            <button class='btn btn-warning btn-sm' data-bs-toggle="modal" data-bs-target="#EmpresaEditModal" onclick="editarEmpresa('<?php echo $ver[0]?>')">
			<i class="fa fa-pencil"></i>
                            </button>
        </td>
		<td>
			<button class='btn btn-danger btn-sm' onclick="eliminaEmpresa('<?php echo $ver[0]?>')">
			<i class="fa fa-trash"></i>
                            </button>
		</td>
	</tr>
	<?php 
	endwhile; ?>
</table>
</body>


