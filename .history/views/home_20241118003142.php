<?php if ($resultado && $resultado->rowCount() > 0): ?>
    <div class="results-container">
        <h2 class="results-title">Resultados de la Consulta</h2>
        <div class="results-grid">
            <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="result-card">
                    <div class="card-header">
                        <h3><?= htmlspecialchars($row['fabricante'] ?? 'Producto') ?></h3>
                    </div>
                    <div class="card-content">
                        <?php if (isset($row['producto'])): ?>
                            <p class="product-name"><?= htmlspecialchars($row['producto']) ?></p>
                            <div class="price-info">
                                <p class="price-base">Base: €<?= number_format($row['base'], 2) ?></p>
                                <p class="price-iva">IVA: €<?= number_format($row['iva'], 2) ?></p>
                                <p class="price-total">Total: €<?= number_format($row['precio_total'], 2) ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($row['total_productos'])): ?>
                            <div class="stats-info">
                                <p>Total productos: <?= $row['total_productos'] ?></p>
                                <p>Precio medio: €<?= number_format($row['precio_medio'], 2) ?></p>
                                <div class="price-range">
                                    <p>Mínimo: €<?= number_format($row['precio_min'], 2) ?></p>
                                    <p>Máximo: €<?= number_format($row['precio_max'], 2) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php elseif (isset($consulta) || isset($busqueda)): ?>
    <div class="no-results">
        <p>No se encontraron resultados para esta consulta</p>
    </div>
<?php endif; ?>