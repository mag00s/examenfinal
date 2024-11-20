CREATE OR REPLACE VIEW vista_enlaces AS
SELECT 
    v.pk_vinculo AS id_vinculo,
    v.titulo AS titulo,
    v.enlace AS url,
    v.fk_categoria AS categoria_id,  -- Foreign key
    c.categoria AS nombre_categoria,  -- Category name from categoria table
    c.tipo AS tipo_categoria           -- Added 'tipo' column from categoria table
FROM vinculos v
LEFT JOIN categoria c ON v.fk_categoria = c.pk_categoria;
