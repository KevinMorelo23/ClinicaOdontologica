# Panel de Gestión de Citas - Clínica Odontológica

Este es un sistema de gestión de citas para una clínica odontológica desarrollado con **Laravel** y **Filament**. Permite la administración de clientes, doctores, citas y roles de usuarios con permisos específicos.

## 🚀 Características

-   Gestión de clientes, doctores y citas.
-   Asignación de citas con fecha, hora y estado.
-   Control de acceso basado en roles (**Admin**, **Recepcionista**, **Doctor**).
-   Los doctores solo pueden ver sus propias citas.
-   Panel de administración con Filament.

## 📌 Requisitos

-   PHP >= 8.1
-   Laravel >= 10
-   Composer
-   Node.js y npm (para assets opcionales)
-   Base de datos MySQL o PostgreSQL

## 💞 Instalación

1. Clonar el repositorio:

    ```sh
    git clone https://github.com/KevinMorelo23/ClinicaOdontologica.git
    cd tu-repositorio
    ```

2. Instalar dependencias:

    ```sh
    composer install
    ```

3. Configurar el archivo `.env`:

    ```sh
    cp .env.example .env
    ```

    - Configura la conexión a la base de datos en el archivo `.env`.

4. Generar la clave de aplicación:

    ```sh
    php artisan key:generate
    ```

5. Ejecutar migraciones y seeders:

    ```sh
    php artisan migrate --seed
    ```

6. Iniciar el servidor:
    ```sh
    php artisan serve
    ```

## 🔑 Roles y Permisos

| Rol               | Acceso                                                                   |
| ----------------- | ------------------------------------------------------------------------ |
| **Admin**         | Puede gestionar todos los módulos                                        |
| **Recepcionista** | Puede ver el dashboard, citas, clientes y doctores (sin editar doctores) |
| **Doctor**        | Puede ver y gestionar sus propias citas y clientes                       |

## 📂 Estructura del Proyecto

```
├───Filament
│   ├───Resources
│   │   ├───CitaResource
│   │   │   └───Pages
│   │   ├───ClienteResource
│   │   │   ├───Pages
│   │   │   └───RelationManagers
│   │   ├───DoctorResource
│   │   │   ├───Pages
│   │   │   └───RelationManagers
│   │   ├───RoleResource
│   │   │   └───Pages
│   │   └───UserResource
│   │       └───Pages
│   └───Widgets
├───Http
│   └───Controllers
├───Models
└───Providers
    └───Filament
```

## 💜 Licencia

Este proyecto está bajo la licencia **MIT**.
