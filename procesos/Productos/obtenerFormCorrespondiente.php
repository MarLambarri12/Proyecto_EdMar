<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_EdMar/bd/conexion.php';
if (isset($_POST['id_subcategoria'])) {
    $id_subcategoria = $_POST['id_subcategoria'];

    //Seleccionamos el formulario correcto segun el id
    $query = "SELECT c.nombre_categoria  FROM subcategorias s
    JOIN categorias c ON s.id_categoria = c.id_categoria
    WHERE s.id_subcategoria = ?";

    if($stmt = $conn->prepare($query)){
    $stmt->bind_param("i", $id_subcategoria);
    $stmt->execute();
    $stmt->bind_result($nombre_categoria);
    $stmt->fetch();
    $stmt->close();

    //Mostrar el formulario para la categoria general
    if ($nombre_categoria == 'Dispositivos inteligentes') {
    echo '<form>
    <div class="row mb-3">
        <div class="col">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marcaIdForm" name="marcaForm">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="almacenamiento" class="form-label">Capacidad de almacenamiento</label>
            <input type="text" class="form-control" id="almacenamiendoId" name="almacenamientoForm">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="RAM" class="form-label">Memoria RAM</label>
            <input type="text" class="form-control" id="RAMId" name="RAMForm">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="procesador" class="form-label">Procesador</label>
            <input type="text" class="form-control" id="procesadorId" name="procesadorForm">
        </div>
    </div>
   <div class="row mb-3">
        <div class="col">
            <label for="pulgadas" class="form-label">Pulgadas de la pantalla</label>
            <input type="text" class="form-control" id="pulgadasId" name="pulgadasForm">
        </div>
        </div>
    <div class="row mb-3">
        <div class="col">
            <label for="conectividad" class="form-label">Conectividad</label>
            <input type="text" class="form-control" id="conectividadId" name="conectividadName">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="so" class="form-label">Sistema Operativo</label>
            <input type="text" class="form-control" id="soId" name="soForm">
        </div>
    </div>
</form>';
    } else if($nombre_categoria == 'Moda y Ropa'){
        echo '<form>
        <div class="row mb-3">
            <div class="col">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marcaIdForm" name="marcaForm">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="talla" class="form-label">Talla</label>
                <input type="text" class="form-control" id="tallaId" name="tallaForm">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="sexo" class="form-label">Sexo</label>
                <input type="text" class="form-control" id="sexoId" name="sexoForm">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="colorId" name="colorForm">
            </div>
        </div>
    </form>';
    } else if($nombre_categoria == 'Salud y Belleza'){
        echo '<form>
        <div class="row mb-3">
            <div class="col">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marcaIdForm" name="marcaForm">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="tamano" class="form-label">Tamaño</label>
                <input type="text" class="form-control" id="tamanoId" name="tamanoForm">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="tipo" class="form-label">Tipo de piel o cabello</label>
                <input type="text" class="form-control" id="tipoId" name="tipoForm">
            </div>
        </div>
    </form>';
    }
}
}
/* QUE EL USUARIO PUEDA ELEGIR CUALQUIER ATRIBUTO Y UNA TABLA PARA INFANTIL DAMA CABALLERO */