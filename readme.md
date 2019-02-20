# Proyecto examen para ECommerce Farm

Este repositorio contiene el examen de nivel para ECommerce Farm.

## Instrucciones de uso ##

La aplicación dispone de dos usuarios estáticos con identificadores 1 y 2. Sustituya en los siguientes comandos
la variable [id\_usuario] por uno de estos valores.


### Para lanzar el comando desde consola

  * Ejecute el siguiente comando desde la terminal

    `php artisan send_notification [id_usuario]`


### Para lanzar la petición a través de la api

  * Arrancar el servidor web en desarrollo
  
    `php artisan serve`
  
  * Ejecute el siguiente comando desde la terminal
  
    `curl -i -H "Accept: application/json" "http://localhost/api/v1/users/send_notification/[id_usuario]"`