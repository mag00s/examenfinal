# Gestor de Enlaces - Documentación Técnica
![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![MVC](https://img.shields.io/badge/Pattern-MVC-green)

## Información del Proyecto
- **Autor:** Marc Urruela
- **Fecha:** 19/11/2024
- **Asignatura:** MF0227_3 PROGRAMACIÓN ORIENTADA A OBJETOS
- **Módulo:** Programación con Lenguajes Orientados a Objetos y Bases de Datos Relacionales
- **Centro:** CIFO L'Hospitalet
- **GitHub:** [mag00s](https://github.com/mag00s)

## 1. Análisis de Requisitos

### 1.1 Requisitos Funcionales ⚙️
- ✅ Crear vista SQL para enlaces y categorías
- ✅ Implementar búsqueda por categoría
- ✅ Implementar búsqueda por lenguaje de programación
- ✅ Implementar búsqueda por título
- ✅ Mostrar resultados en formato tabla

### 1.2 Requisitos Técnicos 🛠️
- ✅ Implementar arquitectura MVC
- ✅ Utilizar POO en PHP
- ✅ Conectar con base de datos MySQL
- ✅ Gestión de rutas

## 2. Diseño

### 2.1 Estructura de Base de Datos 💾
```sql
-- Vista principal de enlaces
CREATE OR REPLACE VIEW vista_enlaces AS
SELECT 
    v.pk_vinculo AS id_vinculo,
    v.titulo AS titulo,
    v.enlace AS url,
    v.fk_categoria AS categoria_id,
    c.categoria AS nombre_categoria,
    c.tipo AS tipo_categoria
FROM vinculos v 
LEFT JOIN categoria c ON v.fk_categoria = c.pk_categoria;
```

### 2.2 Estructura del Proyecto 📁
```
examenfinal/
├── 📁 config/
│   └── Database.php
├── 📁 models/
│   └── ModelBBDD.php
├── 📁 controllers/
│   └── ViewController.php
├── 📁 views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── index.php
│   └── results.php
├── 📁 router/
│   └── Router.php
└── index.php
```

## 3. Implementación

### 3.1 Patrón MVC 🏗️
- **Modelo (M)**: 
  - Gestión de datos
  - Consultas SQL
  - Validación de datos
- **Vista (V)**:
  - Interfaz de usuario
  - Formularios de búsqueda
  - Presentación de resultados
- **Controlador (C)**:
  - Lógica de negocio
  - Sistema de routing
  - Gestión de peticiones

### 3.2 Funcionalidades Implementadas ✨
- Sistema de búsqueda multicriteria
- Routing dinámico
- Gestión de vistas modular
- Manejo de errores y excepciones

## 4. Pruebas y Validación 🧪

### 4.1 Pruebas Realizadas
- ✅ Conexión a base de datos
- ✅ Búsquedas por criterios
- ✅ Validación de resultados
- ✅ Sistema de routing
- ✅ Gestión de errores

### 4.2 Resultados de Pruebas
- Tiempo de respuesta < 1s
- Resultados precisos
- Interfaz responsive
- Gestión de errores robusta

## 5. Despliegue e Instalación 🚀

### 5.1 Requisitos Previos
- PHP 8.0 o superior
- MySQL 8.0 o superior
- Apache con mod_rewrite
- Composer (opcional)

### 5.2 Pasos de Instalación
1. Clonar repositorio
2. Importar base de datos
3. Configurar credenciales
4. Verificar permisos
5. Configurar virtual host

## 6. Conclusiones y Mejoras Futuras 🎯

### 6.1 Objetivos Cumplidos
- ✅ Implementación MVC completa
- ✅ Sistema de búsqueda funcional
- ✅ Interfaz intuitiva
- ✅ Código documentado

### 6.2 Mejoras Propuestas
- 📌 Sistema de paginación
- 📌 Cache de consultas
- 📌 Panel de administración
- 📌 API REST

---
> **Nota:** Este documento forma parte del proyecto final del módulo MF0227_3.