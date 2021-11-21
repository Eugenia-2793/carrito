<?php
$Titulo = "Agregar Producto";
include_once("../../estructura/cabecera.php");

?>

<div class="content p-3">
    <h2 class="h2 mb-3 text-center">Agregar Producto</h2>

    <!-- Tipo Producto -->
    <div class="form-signin mx-auto mb-3">
        <select id="tipoProducto" name="tipoProducto" class="form-select" required onclick="check()">
            <option value="">Seleccione el tipo de Producto</option>
            <option value="1">Combo</option>
            <option value="2">Película</option>
        </select>
    </div>

    <!-- Agregar Combo -->
    <div id="agregarCombo">
        <form id="agregarProducto" name="agregarProducto" method="POST" action="abmProducto.php" data-toggle="validator" enctype="multipart/form-data">
            <div class="form-signin mx-auto">
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="firstName">Nombre</label>
                    <input type="text" class="form-control" name="pronombre" id="pronombre" placeholder="Nombre" required>
                    <div class="invalid-feedback">
                        Nombre incorrecto
                    </div>
                </div>
                <!-- Stock -->
                <div class="mb-3">
                    <label for="minutos">Stock</label>
                    <input type="number" class="form-control" id="procantstock" name="procantstock" placeholder="Ej: 10" aria-describedby="cant" min="0" max="250" required>
                </div>
                <!-- Precio -->
                <div class="mb-3">
                    <label for="minutos">Precio</label>
                    <input type="number" class="form-control" id="proprecio" name="proprecio" placeholder="Ej: 120" aria-describedby="cant" min="1" max="2000" required>
                </div>
                <!-- Detalles -->
                <div class="mb-3">
                    <label for=" sinopsis">Detalles</label>
                    <textarea class="form-control" id="prodetalle" name="prodetalle" placeholder="Ingrese detalles del combo" required></textarea>
                    <div class="invalid-feedback">
                        Debe ingresar detalles del combo
                    </div>
                </div>
                <!-- Portada -->
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen del Combo</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                    <div id="RA" class="form-text">
                        Solo se permiten imágenes - Relación de aspecto de 3/2
                    </div>
                </div>
                <!-- accion = crear, idusuario y tipo = combo (input oculto) -->
                <input id="accion" name="accion" value="crear" type="hidden">
                <input id="idproducto" name="idproducto" value="null" type="hidden">
                <input id="protipo" name="protipo" value="combo" type="hidden">
                <!-- Botón enviar -->
                <div class="mb-5">
                    <input id="btn_agregarCombo" class="w-100 btn btn-lg btn-primary" name="btn_agregarCombo" type="submit" value="Enviar">
                </div>
            </div>
        </form>
    </div>
    <!-- Agregar Película -->
    <div id="agregarPelícula">
        <form id="agregarProducto" name="agregarProducto" method="POST" action="abmProducto.php" data-toggle="validator" enctype="multipart/form-data">
            <div class="row mx-md-3 justify-content-center justify-content-md-start">
                <!-- Título -->
                <div class="col-md-6 mb-3">
                    <label for="firstName">Título</label>
                    <input type="text" class="form-control" name="pronombre" id="pronombre" placeholder="Título" required>
                    <div class="invalid-feedback">
                        Título incorrecto
                    </div>
                </div>
                <!-- Actores -->
                <div class="col-md-6 mb-3">
                    <label for="actores">Actores</label>
                    <input type="text" class="form-control" id="actores" name="actores" placeholder="Actores" required>
                    <div class="invalid-feedback">
                        Ingrese el nombre de los actores
                    </div>
                </div>
                <!-- Director -->
                <div class="col-md-6 mb-3">
                    <label for="director">Director</label>
                    <input type="text" class="form-control" id="director" name="director" placeholder="Director" required>
                    <div class="invalid-feedback">
                        Ingrese el nombre del director
                    </div>
                </div>
                <!-- Guión -->
                <div class="col-md-6 mb-3">
                    <label for="guion">Guión</label>
                    <input type="text" class="form-control" id="guion" name="guion" placeholder="Guión" required>
                    <div class="invalid-feedback">
                        Ingrese el guión de la película
                    </div>
                </div>
                <!-- Producción -->
                <div class="col-md-6 mb-3">
                    <label for="produccion">Producción</label>
                    <input type="text" class="form-control" id="produccion" name="produccion" placeholder="Producción" required>
                    <div class="invalid-feedback">
                        Ingrese el nombre de la producción
                    </div>
                </div>
                <!-- Año -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="year">Año</label>
                    <input type="number" class="form-control" id="year" name="year" placeholder="Ej: 1991" min="1900" max="2021" required>
                    <div class="invalid-feedback">
                        Ingrese el año de la película
                    </div>
                </div>
                <!-- Nacionalidad -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="nacion">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacion" name="nacion" placeholder="Ej: Japonesa" required>
                    <div class="invalid-feedback">
                        Ingrese la nacionalidad
                    </div>
                </div>
                <!-- Género -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="genero">Género</label>
                    <select class="form-select d-block w-100" id="genero" name="genero" required>
                        <option value="Acción">Acción</option>
                        <option value="Comedia">Comedia</option>
                        <option value="Drama">Drama</option>
                        <option value="Romántica">Romántica</option>
                        <option value="Suspenso">Suspenso</option>
                        <option value="Terror">Terror</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un genero.
                    </div>
                </div>
                <!-- Duración -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="minutos">Duración</label>
                    <input type="number" class="form-control" id="minutos" name="minutos" placeholder="Ej: 120" aria-describedby="enMin" min="1" max="250" required>
                    <div id="enMin" class="form-text">
                        Minutos
                    </div>
                </div>
                <!-- Stock -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="minutos">Stock</label>
                    <input type="number" class="form-control" id="procantstock" name="procantstock" placeholder="Ej: 10" aria-describedby="cant" min="0" max="250" required>
                </div>
                <!-- Precio -->
                <div class="col-sm-6 col-lg-3 mb-3">
                    <label for="minutos">Precio</label>
                    <input type="number" class="form-control" id="proprecio" name="proprecio" placeholder="Ej: 120" aria-describedby="cant" min="1" max="2000" required>
                    <div id="enPesos" class="form-text">
                        Pesos
                    </div>
                </div>
            </div>
            <!-- Edad -->
            <div class="row mx-md-3 justify-content-center justify-content-sm-start mb-3">
                <legend class="col-form-label col-sm-8">Restricciones de edad</legend>
                <div class="col-sm-8 col-md-11">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="edad" id="edad" value="tp">
                        <label class="form-check-label" for="edad">Todo Público</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="edad" id="edad" value="ms">
                        <label class="form-check-label" for="edad">Mayores de 7 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="edad" id="edad" value="md">
                        <label class="form-check-label" for="edad">Mayores de 18 años</label>
                    </div>
                </div>
            </div>
            <!-- Sinopsis -->
            <div class="row mx-md-3 justify-content-center justify-content-sm-start mb-3">
                <div class="col-md-12">
                    <label for=" sinopsis">Sinopsis</label>
                    <textarea class="form-control" id="sinopsis" name="sinopsis" placeholder="Ingrese la sinopsis de la película" required></textarea>
                    <div class="invalid-feedback">
                        Debe ingresarse la sinopsis de la película
                    </div>
                </div>
            </div>
            <!-- Portada -->
            <div class="row mx-md-3 justify-content-center justify-content-sm-start mb-3">
                <div class="col col-lg-8">
                    <label for="imagen" class="form-label">Portada de la película</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*" required>
                    <div id="RA" class="form-text">
                        Solo se permiten imágenes - Relación de aspecto de 2/3
                    </div>
                </div>
            </div>
            <!-- accion = crear, idproducto y tipo = pelicula (input oculto) -->
            <input id="accion" name="accion" value="crear" type="hidden">
            <input id="idproducto" name="idproducto" value="DEFAULT" type="hidden">
            <input id="protipo" name="protipo" value="pelicula" type="hidden">
            <input id="prodetalle" name="prodetalle" value="Una peli..." type="hidden">
            <!-- Botón enviar -->
            <div class="d-grid gap-2 col-8 col-sm-4 col-md-3 mx-auto mb-5">
                <input id="btn_agregarPelicula" class="btn btn-primary btn-lg" name="btn_agregarPelicula" type="submit" value="Enviar">
            </div>
        </form>
    </div>
</div>

<?php
include_once("../../estructura/pie.php");
?>