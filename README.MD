# SlimEloquent

Una pequeña prueba del framework Slim combinado con Eloquent que permite crear API escritas en PHP de una manera bastante rápida y simple utilizando la libreria ORM.

## Clonar el repositorio

Ejecutar el comando `git clone https://github.com/IsaacYAGI/slimeloquent.git`

Posicionarse en la carpeta con `cd slimeloquent`

## Instalación

Para correr esta app de prueba se requiere tener WAMP o XAMP instalado así como Composer para bajar las despendencias y mover los archivos a las carpetas de acceso publico en el servidor.

Se debe segurar que se está dentro de la raiz de la carpeta y ejecutar el comando `composer install`. Esto descargará todas las dependencias del proyecto.

Además de esto se debe crear la base de datos con nombre `slimeloquent` y crear las tablas y data de pruebas con el script ubicado en `src/BD/slimeloquent.sql`

El repositorio también tiene un archivo XML `src/BD/tablas_users_posts.xml` que puede ser abierto con el programa **DBDesignerFork-1.5** para visualizar de manera gráfica la estructura de la base de datos.

## Pruebas sobre tabla DEVS

#### Obtener todos los registros de la tabla devs
Para obtener todos los registros de la tabla `devs` se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/devs`, se retornará un JSON con los datos de los mismos.

#### Obtener uno de los registros de la tabla devs

Para obtener uno de los registros de la tabla `devs` se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/devs/{ID}`, se retornará un JSON con los datos del registro. 

Ejemplo: `localhost/slimeloquent/public/index.php/devs/1`

#### Agregar un registro a la tabla devs

Para agregar un registro a la tabla `devs` se debe enviar una petición `POST` a la ruta `localhost/slimeloquent/public/index.php/devs` con los siguientes datos en formato JSON: 
	- name
	- focus
	- hireDate
Ejemplo: 
```
{
  "name":"name",
  "focus":"YES",
  "hireDate":"2017-10-17",
}
```
Nota: se debe agregar en el Header de la solicitud `Content-Type` con valor `application/json` para que funcione correctamente.

#### Actualizar un registro en la tabla devs

Para actualizar un registro en la tabla `devs` se debe enviar una petición `PUT` a la ruta `localhost/slimeloquent/public/index.php/devs/{ID}`, los siguientes datos en formato JSON: 
	- name
	- focus
	- hireDate
Ejemplo: 

Enviar por método `PUT` a la URL `localhost/slimeloquent/public/index.php/devs/1` un JSON con los siguientes datos:

```
{
  "name":"new name",
  "focus":"NO",
  "hireDate":"2017-01-01",
}
```
Nota: se debe agregar en el Header de la solicitud `Content-Type` con valor `application/json` para que funcione correctamente. También se deben enviar todos los datos de la solicitud y solo cambiar los que se deseen. No puede haber valores vacíos.

#### Eliminar uno de los registros de la tabla devs

Para eliminar uno de los registros de la tabla `devs` se debe enviar una petición `DELETE` a la ruta `localhost/slimeloquent/public/index.php/devs/{ID}`.

Ejemplo: `localhost/slimeloquent/public/index.php/devs/2`

## Pruebas sobre tabla USERS

#### Obtener todos los registros de la tabla users
Para obtener todos los registros de la tabla `users` se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/users`, se retornará un JSON con los datos de los mismos.

#### Obtener todos los registros de la tabla posts asociados a un usuario
Para obtener todos los registros de la tabla `posts` asociados a un usuario específico se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/userPosts/{id}`, se retornará un JSON con los datos de los mismos.

Ejemplo: `localhost/slimeloquent/public/index.php/userPosts/1`

#### Obtener un registro de la tabla user y sus post asociados.
Para obtener los datos de un usuario y todos los posts asociados al mismo se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/userAndPosts/{id}`, se retornará un JSON con los datos de los mismos.

Ejemplo: `localhost/slimeloquent/public/index.php/userAndPosts/1`

#### Obtener todos los registros de la tabla user y sus post asociados.
Para obtener todos los datos de los usuarios usuario y todos los posts asociados a los mismos se debe enviar una petición `GET` a la ruta `localhost/slimeloquent/public/index.php/usersAndPosts`, se retornará un JSON con los datos solicitados.