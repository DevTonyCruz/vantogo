<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Proyecto Arca

Proyecto desarrollado por Estrasol para fungir como base inicial de proyectos de software factory,
el desarrollo proporciona herramientas y moódulos iniciales de cualquier desarrollo interno.

Módulos Actuales

- Roles.
- Usuarios.
- Configuraciones.
- Categorías.
- Productos.
- Temas.
- Preguntas frecuentes.
- Páginas.

## Iniciar proyecto

Pasos para iniciar el proyecto:

- Crear fork del proyecto
- Ejecutar los siguientes comandos
~~~~
composer update
npm update
php artisan migrate
php artisan db:seed
~~~~

## Agregar permisos

Al crear un nuevo módulo se tiene que agregar los permisos del mismo, para esto se debe de agregar dentro
de la carpeta database/data/permissions un archivo json que internamente debe de contener la estructura con
los permisos de ese modulo.

Los permisos se tomas del nombre que se le asigana a las rutas de cada módulo. Ejemplo:

~~~~
Route::get('login', 'Web\Admin\Auth\LoginController@showLoginForm')->name('admin.login');  
NOMBRE DE LA RUTA "admin.login"
~~~~

Estructura de permisos

```json
[{
    "modulo": "Admin",
    "data": [{
        "name": "Dashboard",
        "controller": "Admin",
        "slug": "admin.home"
    }]
}]
```

Como se puede apreciar en la estructura el nombre de la ruta se coloca en 
el campos slug.

Después de haber realizado esto se debe ejecutar el siguiente comando:

~~~~
php artisan db:seed --class=PermissionsSeeder
~~~~

## Contribución

- Desarrollador: Antonio Tenorio
- Desarrollador: Rufino Santiago
- Desarrollador: David Chavez
- Tester: Fernando Chavez
