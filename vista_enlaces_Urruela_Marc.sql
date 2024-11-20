-- vista_enlaces_[Apellido]_[Nombre].sql
/**
 * Vista: vista_enlaces
 * Autor: mag00s
 * Fecha: 19/11/2024
 * Descripción: Vista que une las tablas vinculos y categoria
 */

CREATE OR REPLACE VIEW vista_enlaces AS
SELECT 
    v.pk_vinculo AS id_vinculo,
    v.titulo AS titulo,
    v.enlace AS url,
    v.fk_categoria AS categoria_id,
    c.categoria AS nombre_categoria,
    c.tipo AS tipo_categoria
FROM 
    vinculos v 
LEFT JOIN 
    categoria c ON v.fk_categoria = c.pk_categoria
ORDER BY 
    c.categoria ASC;