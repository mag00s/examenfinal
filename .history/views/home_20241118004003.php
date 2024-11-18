<div class="container py-4">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Programación Orientada a Objetos</h1>
        <div class="border-bottom border-primary w-25 mx-auto my-4"></div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <!-- Search Form -->
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" 
                           name="busqueda" 
                           class="form-control form-control-lg" 
                           placeholder="Buscar productos..."
                           value="<?= htmlspecialchars($busqueda ?? '') ?>">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>

            <!-- Queries Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h2 class="h5 mb-0">Consultas Disponibles</h2>
                </div>
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="d-flex flex-column gap-3">
                            <div class="form-check p-3 border rounded hover-bg-light">
                                <input class="form-check-input" type="radio" name="consulta" id="query1" value="1" 
                                       <?= ($consulta ?? '') === '1' ? 'checked' : '' ?>>
                                <label class="form-check-label w-100" for="query1">
                                    Productos más caros por fabricante
                                </label>
                            </div>

                            <div class="form-check p-3 border rounded hover-bg-light">
                                <input class="form-check-input" type="radio" name="consulta" id="query2" value="2"
                                       <?= ($consulta ?? '') === '2' ? 'checked' : '' ?>>
                                <label class="form-check-label w-100" for="query2">
                                    Resumen por fabricante
                                </label>
                            </div>

                            <div class="form-check p-3 border rounded hover-bg-light">
                                <input class="form-check-input" type="radio" name="consulta" id="query3" value="3"
                                       <?= ($consulta ?? '') === '3' ? 'checked' : '' ?>>
                                <label class="form-check-label w-100" for="query3">
                                    Productos bajo precio medio
                                </label>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                Consultar Base de Datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>