<?php
/**
 * Vista: Index
 * Descripción: Página principal con formulario de búsqueda
 * 
 * Ubicación: /views/index.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

require_once 'layout/header.php';
?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Búsqueda por Categoría</h5>
            </div>
            <div class="card-body">
                <form action="/buscar" method="POST">
                    <input type="hidden" name="tipo" value="categoria">
                    <select name="valor" class="form-select mb-3" required>
                        <option value="">Seleccionar categoría</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['nombre_categoria']) ?>">
                                <?= htmlspecialchars($cat['nombre_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Lenguajes de Programación</h5>
            </div>
            <div class="card-body">
                <form action="/buscar" method="POST">
                    <input type="hidden" name="tipo" value="lenguaje">
                    <p class="card-text">Ver todos los enlaces de lenguajes de programación</p>
                    <button type="submit" class="btn btn-primary">Mostrar Lenguajes</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Búsqueda por Título</h5>
            </div>
            <div class="card-body">
                <form action="/buscar" method="POST">
                    <input type="hidden" name="tipo" value="titulo">
                    <input type="text" name="valor" class="form-control mb-3" placeholder="Buscar en títulos..." required>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'layout/footer.php';