# Documentación de la API

## Configuración del Proyecto

### Prerrequisitos

- PHP 8.x
- Composer
- MySQL o MariaDB
- Laravel 10.x
- Node.js

### Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/JymmyMurillo/codespaces-laravel_Baumsoft.git
   cd codespaces-laravel_Baumsoft
   ```

2. Instalar dependencias:

   ```bash
   composer install
   npm install
   ```

3. Configurar el entorno:

   - Copiar el archivo `.env.example` a `.env`
   - Configurar credenciales de la base de datos en `.env`

4. Generar la clave de aplicación:

   ```bash
   php artisan key:generate
   ```

5. Ejecutar migraciones:

   ```bash
   php artisan migrate
   ```

6. Iniciar el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

---


# Endpoints de la API

---

## 1. Crear un Usuario

**Método:** GET

**URL:** `http://localhost:8000/usuarios/crear`

### Parámetros:

- **correo** (string, requerido, único): Correo electrónico del usuario.
- **nombres** (string, requerido): Nombres del usuario.
- **apellidos** (string, requerido): Apellidos del usuario.

### Ejemplo de URL:

```
http://localhost:8000/usuarios/crear?correo=test@example.com&nombres=Juan&apellidos=Perez
```

### Respuesta exitosa (Código 201):

```json
{
    "message": "Usuario creado",
    "usuario": {
        "id": 1,
        "correo": "test@example.com",
        "nombres": "Juan",
        "apellidos": "Perez",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:00:00.000000Z"
    }
}
```

### Respuesta con error de validación (Código 422):

```json
{
    "message": "Error de validación",
    "errors": {
        "correo": ["El correo ya ha sido tomado."]
    }
}
```

### Respuesta con error de servidor (Código 500):

```json
{
    "message": "Error al crear el usuario",
    "error": "SQLSTATE[HY000] [2002] Connection refused"
}
```
---

## 2. Modificar un Usuario

**Método:** GET

**URL:** `http://localhost:8000/usuarios/modificar/{id}`

## Parámetros:

- **id** (entero, requerido): ID del usuario a modificar.
- **correo** (string, opcional, único): Nuevo correo electrónico.
- **nombres** (string, opcional): Nuevos nombres.
- **apellidos** (string, opcional): Nuevos apellidos.

## Ejemplo de URL:

```
http://localhost:8000/usuarios/modificar/1?correo=nuevo@example.com&nombres=Pedro&apellidos=Gomez
```

## Respuesta exitosa (Código 200):

```json
{
    "message": "Usuario actualizado",
    "usuario": {
        "id": 1,
        "correo": "nuevo@example.com",
        "nombres": "Pedro",
        "apellidos": "Gomez",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:30:00.000000Z"
    }
}
```

## Respuesta con error de validación (Código 422):

```json
{
    "message": "Error de validación",
    "errors": {
        "correo": ["El correo ya ha sido tomado."]
    }
}
```

## Respuesta con error de servidor (Código 500):

```json
{
    "message": "Error al modificar el usuario",
    "error": "SQLSTATE[HY000] [2002] Connection refused"
}
```

---

## 3. Eliminar un Usuario

**Método:** GET

**URL:** `http://localhost:8000/usuarios/eliminar/{id}`

## Parámetros:

- **id** (entero, requerido): ID del usuario a eliminar.

## Ejemplo de URL:

```
http://localhost:8000/usuarios/eliminar/1
```

## Respuesta exitosa (Código 200):

```json
{
    "message": "Usuario eliminado",
    "usuario": {
        "id": 1,
        "correo": "test@example.com",
        "nombres": "Juan",
        "apellidos": "Perez",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:00:00.000000Z"
    }
}
```

## Respuesta con error de servidor (Código 500):

```json
{
    "message": "Error al eliminar el usuario",
    "error": "SQLSTATE[HY000] [2002] Connection refused"
}
```
---

# 4. Consultar un Usuario

**Método:** GET

**URL:** `http://localhost:8000/usuarios/consultar/{id}`

## Parámetros:

- **id** (entero, requerido): ID del usuario a consultar.

## Ejemplo de URL:

```
http://localhost:8000/usuarios/consultar/1
```

## Respuesta exitosa (Código 200):

```json
{
    "message": "Usuario consultado",
    "usuario": {
        "id": 1,
        "correo": "test@example.com",
        "nombres": "Juan",
        "apellidos": "Perez",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:00:00.000000Z",
        "ingresos": [
            {
                "id": 1,
                "fecha_entrada": "2023-10-01T12:00:00.000000Z",
                "fecha_salida": "2023-10-01T17:00:00.000000Z",
                "created_at": "2023-10-01T12:00:00.000000Z",
                "updated_at": "2023-10-01T12:00:00.000000Z"
            }
        ]
    }
}
```

## Respuesta con error de recurso no encontrado (Código 404):

```json
{
    "message": "Usuario no encontrado",
    "error": "No query results for model [App\\Models\\Usuario] 999"
}
```
---
## 5. Crear un Ingreso

**Método:** GET  

**URL:** `http://localhost:8000/ingresos/crear/{usuario_id}`  

### Parámetros:
- `usuario_id` (entero, requerido): ID del usuario al que pertenece el ingreso.

### Ejemplo de URL:
```
http://localhost:8000/ingresos/crear/1
```

### Respuesta exitosa (Código 201):
```json
{
    "message": "Ingreso creado",
    "ingreso": {
        "id": 1,
        "usuario_id": 1,
        "fecha_entrada": "2023-10-01T12:00:00.000000Z",
        "fecha_salida": "2023-10-01T17:00:00.000000Z",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:00:00.000000Z"
    },
    "usuario": {
        "id": 1,
        "correo": "test@example.com",
        "nombres": "Juan",
        "apellidos": "Perez",
        "created_at": "2023-10-01T12:00:00.000000Z",
        "updated_at": "2023-10-01T12:00:00.000000Z"
    }
}
```

### Respuesta con error de servidor (Código 500):
```json
{
    "message": "Error al crear el ingreso",
    "error": "SQLSTATE[HY000] [2002] Connection refused"
}
```
---

## 6. Consultar Todos los Usuarios con Ingresos

**Método:** GET  

**URL:** `http://localhost:8000/usuarios/todos`  

### Respuesta exitosa (Código 200):
```json
{
    "message": "Todos los usuarios con sus ingresos",
    "data": [
        {
            "usuario": {
                "id": 1,
                "correo": "test@example.com",
                "nombres": "Juan",
                "apellidos": "Perez",
                "created_at": "2023-10-01T12:00:00.000000Z",
                "updated_at": "2023-10-01T12:00:00.000000Z"
            },
            "ingresos": [
                {
                    "id": 1,
                    "fecha_entrada": "2023-10-01T12:00:00.000000Z",
                    "fecha_salida": "2023-10-01T17:00:00.000000Z",
                    "created_at": "2023-10-01T12:00:00.000000Z",
                    "updated_at": "2023-10-01T12:00:00.000000Z"
                }
            ]
        }
    ]
}
```

### Respuesta con error de servidor (Código 500):
```json
{
    "message": "Error al consultar los usuarios",
    "error": "SQLSTATE[HY000] [2002] Connection refused"
}
```
---

## Respuestas de Error

- 422: Error de validación
- 404: No encontrado
- 500: Error interno del servidor

---

## Notas

- Todos los endpoints utilizan el método `GET` para facilitar las pruebas en Codespaces.
- Se recomienda usar herramientas como Postman o cURL para probar la API.
- En producción, es mejor usar los métodos HTTP adecuados (`POST`, `PUT`, `DELETE`) para mejorar la seguridad y cumplir con las buenas prácticas.

# Estructura del Proyecto
```
codespaces-laravel_Baumsoft/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── UsuarioController.php
│   │   │   └── IngresoController.php
│   ├── Models/
│   │   ├── Usuario.php
│   │   └── Ingreso.php
├── database/
│   ├── migrations/
│   │   ├── 2023_10_01_000000_create_usuarios_table.php
│   │   └── 2023_10_01_000001_create_ingresos_table.php
├── routes/
│   └── web.php
├── .env
└── composer.json

```
