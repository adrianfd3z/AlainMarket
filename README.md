## ALAINPHONE (Alain Pedrueza, Aitor Gonzalo, Adrian Fernandez, Unai De Leon y Oscar Basaguren)

Este proyecto trata sobre el desarrollo de una página web usando HTML,CSS,JavaScript,PHP,MariaDB y Docker.

Para nuestro proyecto hemos decidido crear una tienda de telefonos moviles con un sistema de venta de segunda mano.
## Instrucciones para el despliegue
1.Situarse en el directorio:
```
$ cd docker-lamp
```
2.Dar permisos al ejecutable ejecutar.sh:
```
$ chmod +x ejecutar.sh
```
3.Ejecutamos el ejecutable al que acabamos de dar permisos:
```
$ ./ejecutar.sh
```
4.Se nos abrira el localhost:8890, el cual nos redirige a phpMyAdmin, donde cargaremos la base de datos **database.sql**:

5.Una vez en PHPMyAdmin iniciar sesión con Usuario: "admin" Contraseña: "test", después hacer click en database e importar la base de datos **database.sql**.

6.El ejecutable anterior ya nos habra abierto una pestaña con el localhost:81, en el cual esta la pagina web. (en caso de problema refresca la pagina).


## Uso de la página
En la pagina de inicio encontraras varias opciones, lo primero que veras sera informacion sobre nosotros y nuestra tienda, además de donde nos encontramos y nuestro correo y telefono de contacto.
 
En la parte superior de la página podras encontrar tres botones, una para volver a la pagina principal, otro para ir a la galeria, donde podras ver nuestra galería de moviles y uno ultimo para registrarte, y en caso de que ya lo estes, iniciar sesión.

Por último, en la parte baja de la pagina de incio encontraras tres botones, uno con el que podras ver los moviles en segunda mano que ofertamos, otro para añadir tu propios moviles de segunda mano para poner en venta, y una ultima para modificar los datos de usuario en caso de que lo necesites.
