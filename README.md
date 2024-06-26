# Proyecto de Gestión de TV Box

Este es un proyecto desarrollado en **Laravel** para la gestión de TV Box utilizadas en un servicio de cartelería digital. Proporciona una API para administrar clientes, TV Box y su estado de pago.

## Características

- **CRUD** completo para clientes y TV Box.
- Estado de pago de TV Box gestionado automáticamente según la fecha de vencimiento. 
- **API RESTful** para acceder a la información de las TV Box.

## Requisitos

- **PHP** >= 7.4
- **Composer**
- **Laravel** 8.x
- **MySQL** o cualquier otro sistema de gestión de bases de datos compatible con Laravel

## Instalación

1. **Clona** el repositorio: `git clone <URL del repositorio>`
2. **Instala** las dependencias: `composer install`
3. **Copia** el archivo de entorno: `cp .env.example .env`
4. **Configura** la conexión a la base de datos en el archivo `.env`
5. **Ejecuta** las migraciones: `php artisan migrate`
6. **Genera un usuario** Ejecuta: `php artisan filament:user` y llena los campos
7. **Inicia** el servidor: `php artisan serve`

## Uso

Puedes acceder al panel de administración en [http://localhost:8000/admin](http://localhost:8000/admin) para gestionar clientes y TV Box. La API está disponible en [http://localhost:8000/api/tvbox-info](http://localhost:8000.test/api/tvbox-info).

### Ejemplo de solicitud API

```http
GET /api/tvbox-info HTTP/1.1
Host: localhost:8000
