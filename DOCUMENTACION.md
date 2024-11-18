# Documentación del Ciclo de Vida de Desarrollo

## 1. Análisis de Requisitos

### 1.1 Requisitos Funcionales
- Crear vista SQL para productos y fabricantes
- Implementar búsqueda por fabricante
- Implementar búsqueda por tipo de producto
- Implementar búsqueda por precio máximo
- Mostrar resultados en formato tabla

### 1.2 Requisitos Técnicos
- Implementar arquitectura MVC
- Utilizar POO en PHP
- Conectar con base de datos MySQL
- Interfaz responsiva

## 2. Diseño

### 2.1 Estructura de Base de Datos
```sql
-- Vista principal de productos y fabricantes
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

### 2.2 Estructura del Proyecto
```
examenfinal/
├── config/
│   └── Database.php
├── models/
│   └── ModelBBDD.php
├── controllers/
│   └── ProductoController.php
├── views/
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   ├── components/
│   │   ├── search.php
│   │   └── results.php
│   └── home.php
├── assets/
│   └── css/
│       └── style.css
└── index.php
```

## 3. Implementación

### 3.1 Configuración del Entorno
1. Instalación de Laragon como servidor local
2. Configuración de PHP 7.4+
3. Configuración de MySQL
4. Creación del repositorio en GitHub

### 3.2 Desarrollo
1. **Base de Datos**
   - Creación de la vista productos_fabricante
   - Verificación de consultas SQL

2. **Modelo**
   - Implementación de la clase ModelBBDD
   - Desarrollo de métodos de consulta
   - Configuración de la conexión a base de datos

3. **Controlador**
   - Implementación de ProductoController
   - Gestión de peticiones
   - Procesamiento de datos

4. **Vistas**
   - Diseño de la interfaz de usuario
   - Implementación de formularios de búsqueda
   - Diseño de la tabla de resultados

## 4. Pruebas

### 4.1 Pruebas Unitarias
- Verificación de conexión a base de datos
- Pruebas de consultas individuales
- Validación de formato de datos

### 4.2 Pruebas de Integración
- Flujo completo de búsqueda
- Integración entre componentes
- Manejo de errores

### 4.3 Pruebas de Usuario
- Validación de interfaz
- Pruebas de responsividad
- Verificación de resultados

## 5. Despliegue

### 5.1 Preparación
1. Creación del repositorio en GitHub
2. Configuración de .gitignore
3. Documentación del proyecto

### 5.2 Control de Versiones
```bash
# Inicialización del repositorio
git init

# Preparación de archivos
git add .

# Commit inicial
git commit -m "Implementación inicial del proyecto POO"

# Conexión con GitHub
git remote add origin https://github.com/mag00s/examenfinal.git

# Subida del proyecto
git push -u origin main
```

### 5.3 Instrucciones de Despliegue
1. Clonar repositorio
2. Importar base de datos
3. Configurar conexión en Database.php
4. Verificar permisos de archivos
5. Configurar servidor web

## 6. Mantenimiento

### 6.1 Mejoras Futuras
- Implementar paginación de resultados
- Añadir filtros adicionales
- Mejorar la interfaz de usuario
- Optimizar consultas SQL

### 6.2 Documentación
- README.md con instrucciones
- Comentarios en el código
- Documentación técnica

## 7. Herramientas Utilizadas
- VSCode como IDE
- Laragon como servidor local
- MySQL Workbench para base de datos
- Git para control de versiones
- GitHub para repositorio remoto

## 8. Conclusiones
El proyecto implementa exitosamente los requisitos del examen, utilizando buenas prácticas de programación y una estructura organizada. La arquitectura MVC facilita el mantenimiento y la escalabilidad del código.

---
Desarrollado por mag00s 🌱