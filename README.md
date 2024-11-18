# Examen Final - Programación Orientada a Objetos

## Descripción del Proyecto
Aplicación web MVC para gestionar una tienda de informática, desarrollada como parte del examen final.

## UF2404 - Principios de la Programación Orientada a Objetos

### 1. Creación de la Vista en SQL
```sql
CREATE OR REPLACE VIEW productos_fabricante AS
SELECT 
    f.pk_codigo AS codigo_fabricante,
    f.nombre AS fabricante,
    p.id_producto,
    p.nombre AS producto,
    p.precio,
    pa.porcentaje_iva,
    ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
    ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
FROM fabricante f
LEFT JOIN producto p ON f.pk_codigo = p.fk_codigo
JOIN parametros pa;
```

### 2. Implementación del Modelo
El objeto ModelBBDD implementa el patrón de diseño DAO (Data Access Object) para gestionar el acceso a datos:

```php
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Métodos de consulta implementados...
}
```

## UF2405 - Modelo de Programación Web y Bases de Datos

### Estructura MVC
```
examenfinal/
├── config/
│   └── Database.php    # Configuración de la base de datos
├── models/
│   └── ModelBBDD.php   # Modelo de datos
├── controllers/
│   └── ProductoController.php   # Controlador
├── views/
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   └── home.php
└── assets/
    └── css/
        └── style.css
```

### Consultas Implementadas

1. **Búsqueda por Fabricante**
```sql
SELECT * FROM productos_fabricante 
WHERE LOWER(fabricante) LIKE LOWER(:fabricante)
```

2. **Búsqueda por Tipo de Producto**
```sql
SELECT * FROM productos_fabricante 
WHERE LOWER(producto) LIKE LOWER(:tipo)
```

3. **Búsqueda por Precio Máximo**
```sql
SELECT * FROM productos_fabricante 
WHERE precio < :precio 
ORDER BY precio ASC
```

## UF2406 - Ciclo de Vida del Desarrollo

### 1. Análisis y Diseño
- Identificación de requisitos
- Diseño de la base de datos
- Planificación de la estructura MVC

### 2. Implementación
1. Creación de la base de datos y vista
2. Desarrollo del modelo de datos (ModelBBDD)
3. Implementación del controlador
4. Diseño e implementación de las vistas
5. Integración de Bootstrap para la interfaz

### 3. Pruebas
- Verificación de consultas SQL
- Pruebas de integración
- Validación de la interfaz de usuario

### 4. Despliegue
1. Configuración del entorno:
   - PHP 7.4+
   - MySQL/MariaDB
   - Servidor web (Apache/Nginx)

2. Pasos de instalación:
   ```bash
   # Clonar repositorio
   git clone https://github.com/mag00s/examenfinal.git

   # Importar base de datos
   mysql -u root -p < basededatos.sql

   # Configurar conexión en config/Database.php
   ```

## Tecnologías Utilizadas
- PHP 7.4+
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- JavaScript

## Patrones de Diseño
- MVC (Model-View-Controller)
- DAO (Data Access Object)
- Singleton (Conexión BD)

## Autor
mag00s 🌱

## Licencia
MIT