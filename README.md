# UF3

Proyecto de Aplicación web con PHP, en este proyecto desarrollaremos y desplegaremos una aplicación web desarrollada con lenguaje PHP, introduciendo tecnologías que no hemos visto en los anteriores proyectos.



**Entrega del proyecto**
--
Aparte de desarrollar el proyecto realizaremos **dos memorias del proyecto** (con capturas de pantalla ):
-  Memoria de trabajo individual con registro del día a día 
- Repertorio git con el código fuente de la aplicación

***PRESENTACION DEL PROYECTO***
--
![[Pasted image 20240416193441.png]]

Todas las capturas de pantalla i extras esta documentado en el Google drive --> *Memoria Proyecto UF 3*.

---
# **PART 1:** *ENTORN DE DESENVOLUPAMENT*

## *1.1 Maquina*
Como vamos a tener que desarrollar una aplicación web con PHP tendremos que volver a satisfacer los requisitos técnicos para poder desplegar esta , es decir, un **ecosistema LAMP** con una versión mínima de *PHP de 8.0*.

**ECOSISTEMA LAMP**	 

1- Instalar el Apache 
```
sudo apt update
sudo apt install apache2

```

2-Instalar MySQL ( o MariaDB)

```
sudo apt install mysql-server
```
Durante la instalación de este te pedirá que establezcas una contraseña para el usuario root de MySQL.****

3-Instalar PHP 8.0 y módulos relacionados:

```
sudo apt install php8.0 libapache2-mod-php8.0 php8.0-mysql
```

4-Configurar Apache para usar PHP:

```
sudo a2enmod php8.0
sudo systemctl restart apache2
```
Esto activara el modulo PHP en Apache y aparte reiniciara el servicio para que los cambios surgan efecto.


**VERIFICACIONES**;

Para verificar el apache tenemos de abrir el navegador i visitar ' http://localhost ', si cuando lo haces ves la pagina de inicio de apache significa que este esta funcionando de manera correcta.

Para verificar MySQL ejecutas el siguiente comando;
```
sudo systemctl status mysql
```
Si ves un mensaje que indica que este esta en ejecución significa que la instalación esta exitosa.

Con todos estos pasos ya hemos generado un entorno LAMO¡P completamente funcional con PHP i con la versión 8.1

Contraseñas provisionales de la maquina virtuall;
![[Pasted image 20240416234341.png]]

## *1.2 IDE*

IDE (Integrated Development Environment) es un programario pensado en facilitar el desarrollo de software con opciones de reconocer lenguajes de programacion,copilacion,depuracion(debug),etc.

Tenemos dos opciones de IDE ya en nuestra maquina virtual local para desarrollar nuestra aplicación web, yo utilizare VSCode.

Para instalar el Visual Studio Code desde la terminal;
```
sudo apt update
sudo apt install code
```
Alfinal lo he acabado instalando de manera grafica por el buscador igual que lo realize en mi ordenador Windows.
Instalo las dos extensiones que hay en el documento.


## *1.3 Código local*

Ahora tenemos de crear un directorio 'web' en nuestra maquina, en la ruta /var/www/html, añadiendo el siguiente fichero php;
```Html 
<!DOCTYPE html>

<html lang="en">

<body>

   <h1>Homepage</h1>

   <p><?php echo "My first PHP web app works!" ?></p>

   <ul>

       <li>Operative system: <?= PHP_OS ?></li>

       <li>Web server: <?= $_SERVER['SERVER_SOFTWARE'] ?></li>

       <li>PHP version: <?= phpversion() ?></li>

   </ul>

</body>

</html>
```

Dentro del directorio tiene de estar bajo el nombre "demo.php"

El primer paso seria crear el directorio 'web' en la ruta /var/ww/html 

```bash
mkdir -p /var/www/html/web
```

Ahora creare i editare el fichero demo.php para poner el codigo que tenemos en el documento del proyecto.

```bash
nano /var/www/html/web/demo.php
```

Para comprobar lo que acabamos de hacer lo podemos ver en http://localhost/web/demo.php

>[!warning]
Recordatorio para poder ver estos por el buscador primero tenemos de iniciar el apache2
```
sudo service apache2 start
```
>[!success]

## *1.4 Código Remoto* 

Este paso nos lo podríamos saltar si nuestro servidor cuenta con una interficie grafica, pero como tenemos de tener en cuenta que nosotros no lo tenemos.
Nunca se trabaja sobre el servidor de producción directamente , por tanto, tenemos de conectarnos con el IDE remotamente sobre la maquina servidora para trabajar gráficamente ( lo podríamos ir haciendo con el editor nano pero nos moriríamos de asco).

Por lo tanto para esto tenemos de configurar la extensión que nos descargamos antes en concreto la *Remote-SSH* de IDE para conectarnos al directorio web de nuestra maquina de desarollo.
Tutoriales que nos deja para poder realizar esto;
- [tutorial oficial ](https://code.visualstudio.com/docs/remote/ssh)
- [tutorial extra](https://diarioprogramador.com/conectar-a-un-servidor-por-ssh-desde-visual-studio-code/)


![[Pasted image 20240417131735.png]]

>[!warning]
Punto de inflexion del proyecto ya que no puedo hacer el tunel ssh del Visual Code con la terminal remota ( la del isard)

Voy ha seguir intentando la conexión del SSH de la maquina actual para no tener que volver ha realizar todas las instalaciones de nuevo.

>[!success]
He conseguido poder realizar la conexion SSH i no tengo de volver a repetir el proceso!!

Para poder luego modificar y que el tunel SSH que hemos realizado funciona tenemos de dar permisos a este sobre la carpeta:

```BASH
sudo chmod -R 777 /var/www/html/web
```

# PART 2**: *DESENVOLUPAMENT V.0.1*

El proyecto deja que crees una aplicacion con tematica libre pero con el fin de implementar un CRUD sobre una sola tabla esta tiene de ser;
![[Pasted image 20240417192011.png]]

## *2.1 Estructura del código*

Durante esta primera versión la organización del código tiene de ser la siguiente;

![[Pasted image 20240417192342.png]]
![[Pasted image 20240417192358.png]]

>[!warning]
Importante utilizar SIEMPRE rutas relativas en nuestra web

***SIGUIENDO LAS EXPLICACIONES DEL PWP REALIZAREMOS LO SIGUIENTE***:

Para conectar el php con la base de datos de MySQL tendremos de intalar un paquete en nuestro sistema i reiniciar el Apache;

```bash
sudo apt install php-mysql
sudo service apache2 restart
```

Para el proyecto haremos servir una base de datos llamada "usuaris" y esta tendra una tabla llamada "dades".

Para hacer la base de datos yo la prefiero hacer de forma grafica asi que voy a instalarme el phpmyadmin para poder hacerlo;

```BASH 
sudo apt update
sudo apt install phpmyadmin
sudo dpkg-reconfigure phpmyadmin
```

Despues de hacer esto tenemos de reiniciar el servidor web para que este surga efecto;
```BASH
sudo systemctl restart apache2
```

***Llegados ha este punto no me funciona el php en la maquina i tengo de volver ha empezar todo el proceso, lo mas seguro que realice todos los pasos igual pero en verde instalar el MySQL instalare el mariadb que no afecta en nada simplemente lo cambio porque prefiero el mariadb i lo que me esta dando problemas es justamente este punto***

Puestos a que no me funciona hare la base de datos por la terminal.( pero lo hare desde un servidor en verde de la primera maquina que utilice.)

Para acceder a Mariadb:

```css 
mysql -u root -p
```

Ahora crearemos una base de datos que se llame 'usuaris';

**![](https://lh7-us.googleusercontent.com/oKhhwG1Rl-gslfbSqS29ymDqGcYwdAN8ZqYg1MXtIrja12vscmfjg6BIUO8IBCjJN8-LF4R4BG09C0NQzwZ2IYmHmM9qiliOMTHWYE9aEMZ7Jzd6ua_YKxv3ffQW-AegS2Pha_YH2omUeQhSVxRFYD0)**


Dentro de esta tenemos de poner una tabla que se llame 'dades' y poner una estructura que sea igual que esta que tenemos en el pwp:

![[Pasted image 20240419151130.png]]


Y asi es como nos ha quedado la nuestra en mariadb(pongo la foto del pwp de la tabla en phpmyadmin ya que si pongo la de mariadb son iguales para verle algo mas de sentido el dia de mañana)

**![](https://lh7-us.googleusercontent.com/cABUJ7x5XVit-MJVrLcZnhFEG59F-Vmxh8dzfDCag6hXJC4832Fikt5cGyLUJoYXnSSOemMIKd62Su8kjq5QlMcJe-kFlHB5SrdVFI1Ng3hYC9zotXfOJ7qusZjqMwxs59wiZgCC6flkOCE_TJCVXnw)**

**CONECTAR LA BASE DE DATOS CON EL PHP**
- Viendo como nos explica el power tenemos de utilizar la siguiente estructura para poder conectarlas:
  ![[Pasted image 20240419003254.png]]


- Esta función abrirá una conexión a la base de datos i guarda la variable '$enllaç' , si se produce cualquier error esta variable contendrá el valor de error.
- Para poder realizar esta función necesitaremos las siguientes variables:

	![[Pasted image 20240419160037.png]]
- Tenemos de realizar el siguiente codigo en el Visual Studio Code para poder enlazar la base de datos con nuestra pagina php;

```PHP
<?php
$enllac = mysqli_connect("localhost:3306", "root", "alumne", "usuaris");
if (!$enllac) {
    echo "Error en la conexión: " . mysqli_connect_error();
} else {
    echo "Conexión con la base de datos realizada";
}
?>

```
	
- Como resultado tenemos este mensaje que es el que hemos programado para saber que hemos hecho correctamente el enlaçe;

	![[Pasted image 20240419160219.png]]


**PARA HACER CONSULTAS EN NUESTRA BASE DE DATOS**

La funcion que haremos servir para hacer consultas en nuestra base de datos es;

![[Pasted image 20240419160512.png]]

Esta función enviara la consulta SQL ' $consulta_sql' a través del enlaçe que hemos hecho.
Las consultas que podemos enviar a la base de datos pueden ser;

- Consulta de selección --> SELECT FROM 
- Consulta de inserción --> INSERT INTO
- Consulta de actualización --> UPDATE SET 
Para poder ver cuantos registros nos devuelve la consulta utilizaremos 

```PHP
$registres = mysqli_num_rows($resultat)
```

Un ejemplo de esta funcion;
- Si nosotros suponemos que en nuestra base de datos tenemos estos datos;

  ![[Pasted image 20240419163644.png]]

- I nosotros escribimos el siguiente código;
```PHP
  <?php
//Creamos el enlaçe de conexion a la base de datos
$enllac = mysqli_connect("localhost:3306", "root", "alumne", "usuaris");

//Comprobamos si la conexion se ha realizado con exito o no
if (!$enllac) {
    echo "Error en la conexión: " . mysqli_connect_error();
} else {
    echo "Conexión con la base de datos realizada";
}

//Realizamos una consulta SQL a la base de datos 
$resultat = mysqli_query($enllac, "SELECT* FROM dades");

//Miramos quantos registros ha devuelto la consulta
echo "La consulta que has realizado ha devuelto " . mysqli_num_rows($resultat) . " registres ";

?>
```


- El resultado en este caso seria este;

  ![[Pasted image 20240419164748.png]]



- En nuestro php el resultado seria este del codigo de antes ( el nuestro primero nos dice que la conexión0 se ha realizado correctamente y luego cuantos registros a devuelto);

  ![[Pasted image 20240419164917.png]]

Para poder recorrer los registros que este nos devuelve la consulta SQL ultilizaremos la siguiente funcion;

```PHP
$registre = msqli_fetch_array($resultat);
```

- Esta funcion nos devolverá un registro del resultado de la consulta cada vez que llamemos de 'array' asociativa ( con los nombres de los campos de la base de datos ) y cuando no queden registros este nos devolverá 'NULL'.

- Ejemplo de esto que estamos hablando vamos a coger el codigo que nos da en el pwp i vams a ver su resultado y para practicar vamos a probar-lo en nuestro php para practicar consultas;

- El codigo es el siguiente;  ( documento del visual --> ej.recorrer.php)
- Resultado; (como no tenemos datos dentro de la base de datos solo se ven las columnas).

- ![[Pasted image 20240422002511.png]]

#####  Después de hacer estas pruebas ya realizamos los codigos finales para que nuestro formulario sea funcional, en este caso voy ha poner la misma explicacion que en el el google drive.

- Vamos a comenzar con el desde mi punto de vista el código más importante ya que es la pagina principal ‘index.php’;

- ![](https://lh7-us.googleusercontent.com/cSPUMeqGbITErnrYp9k06r_KyFTR84P53wm_ht4esfilsfTK2A-_uxO0SBtvu2xbPMuQk_fP4yO0sRKRIsmt7LKiTx57g65FocLiNKHOMjIezyr9cITfdio_oCy5cGse0Tkz-JYpbiKhTHFGP93QnvA)

  

- En este código podemos ver diferentes cosas, comenzamos viendo la conexión a la base de datos con su respectiva comprobación ( este paso se va a repetir una y otra vez en los códigos).

- También podemos ver una estructura de html para que sea un poco más bonita la pantalla inicial con lo típico ‘ bienvenido..’ , lo importante es que podemos ver una tabla en la cual se irán añadiendo y podremos ver los registros de nuestra base de datos pero aparte de eso tenemos dos los links ( Actualizar y Eliminar) que son para poder modificar la tabla ya sea actualizando los datos por si alguien se ha equivocado o ha pedido una actualización de estos o por si quieres eliminar un registro de la base de datos.

  

- Verificación de como se ve este documento php en nuestro navegador; 

- ![](https://lh7-us.googleusercontent.com/AqfqCfoGRTrlbUFKFMZ1yhSnODLB6vkUVUZQ_idW38z4-xT7mk_DW0u0a54tZIrN198VvxwT3XbqiMqoRUmq-P63OeW6-i92veoSfE7HfizQxCaOja3vTaoGCmWcdamWaACrpNXKlj_7mdg1v0y7rMA)

  

- Ahora entraremos en la carpeta de functions, en esta como el nombre lo dice están guardados los códigos que hacen funciones para que el formulario sea funcional;

- Comenzaremos por el documento ‘formulario.php’ que como el nombre dice es el que define el formulario que posteriormente rellenaremos, este es el código;

- ![](https://lh7-us.googleusercontent.com/iISZpDO0baS1Ehya52dalSHzEffUjR3yAXQYAAFdmVfWrzhgqtD4HehAynvhJeoSZk-zvczSbWzHxu6bYpSVa1T67FNegKb5FW-QM6zY97h-UXIgdtt6CSiWobrH0vyVX6MxlSB5cOK1f_Tvez2wlC8)

  

- Este desde mi punto de vista es el código más sencillo y el que menos problemas puede llegar a dar ya que es un html simple con el cual creamos el formulario mediante una tabla como aquí vemos, aparte de esto digo que es el que menos problemas suele traer ya que como podemos ver no tenemos ningún tipo de conexión con la base de datos ni nada.

  

- Vista gráfica desde nuestro navegador;

- ![](https://lh7-us.googleusercontent.com/ETfr6N_UI-tr_qC2GUWlZV1YgngXf7iZ4__FsusYN85FybJpQi9iXIUwN5rVLtnaugS5Q42fvn0PpKeHFpq4BiYBShXn3sPpg8asuXoP_fy9d9SoMY6B_6NtWcOzzxs_p9YhHFcBMA0LiR7SdjrH9Dc)

  

- Para poder rellenar el formulario y que este se guarde tenemos el documento ‘inserció.php’ , este está definido con el siguiente código;

- ![](https://lh7-us.googleusercontent.com/Xjx928qD-GecvfOw8I7kdGe_MPSqB3fpRb8Ges-NN1NEmNQUIqSIzLhgNmeX4kkF6FxL9rgSlGOBmyAwVSu2FF0vl-afS340fOofvNAvuiRZvebd_iVEg082fV_JtqTdmL7pgiNsjgp3rLfKNwohAEc)

  

- En este código volvemos a ver un enlace con la base de datos y su correspondiente comprobación para saber que esta funciona, luego construimos una consulta SQL de inserción a la base de datos que esta realizara la función de que cuando rellenemos el formulario que hemos visto anteriormente y le demos al botón de enviar estos datos vayan y se queden en nuestra base de datos.

- Después de eso vemos un pequeño html para ponerle nombre a la página y vemos cómo comprobamos que la consulta SQL haya funcionado correctamente y le ponemos sus respectivos mensajes informativos para poder ver de forma gráfica si estamos haciéndolo bien o no. Aparte de esto también tiene un enlace para poder volver al index.php y ver el registro que acabamos de añadir.


- Normalmente cuando ponemos nuestros datos en algún sitio suele pasar que con el paso del tiempo tenemos la necesidad de actualizar estos por sus respectivos motivos, pues nuestro formulario también puede realizar esta función pero para esto necesitamos lo siguiente;

- Lo primero de todo que tenemos de realizar es más o menos repetir el proceso que hemos hecho hasta ahora pero en verde para añadir para modificar los datos, entonces, tenemos ‘formulario actualització.php’;

- ![](https://lh7-us.googleusercontent.com/PqdQp3PnCv7dq9Y2xplelRyes1stmIrbGQSWa1qfETPCynQL816zeUv0089lCqSL78jg7OL4QxN4Z4yppPmPLy3x9XUsCcSaPct6DAe4C8Rc5Nw7NZexd5dSGWXvSVvwpo2QU_VsfeXZW7ha307ACo4)


- Bueno no me voy a enrollar mucho con este código para no poner mucho texto en el proyecto, en este tenemos al principio el enlace con la base de datos como siempre y luego tenemos una estructura la cual se basa en un identificador que lo cogeremos según en el registro que cliques para poder modificar ese.


- Vista gráfica desde el navegador 

- ![](https://lh7-us.googleusercontent.com/a402JRN_CX3_9-0TVOINJ1fs1VCoQIQZawbnFWuU0WK9GGwYv6h2Hm4v05TfnhVhIxBxPuRc2nF4Z35vLfbjIvIYVCmU3d-zYSyw3WzJJlKajyqh3DDnmfSR6tgnEsEZ3j7HKLMJUNg68hbLoGPtpQs)

- ( este lo mas seguro que le haga el mismo css que al formulario original para que no se vea tan feo, pero como los que cambian datos siempre son pesados y frecuentes ha hacerlo no pasa nada si esa pestaña es más fea…)

  
- Ahora tenemos un documento que enverde de inserción lo llamaremos actualització, osea, ‘actualització.php’, este tiene el siguiente código;

- ![](https://lh7-us.googleusercontent.com/QkE9Uw0qFgL7kXV8C-VAp1m_gm7iwSBg2D_KiJOUgY2LfIahQW1deu-DvFcfVn4n4oSVbTDodDZSCUh2LOe0Et6LG6EyYPrnjwhRpaOExoMiGvR2poFBA6ib3xk9OCBQj_0_zoI3AoCklshfn_2jhLg)

  
- Este código tiene la función de refrescar los datos que acabamos de introducir, en este al principio del código tenemos como no el enlace a la base de datos y su respectiva comprobación y luego igual que en el anterior código mediante el identificador de registro que tenemos construiremos una consulta de actualización y posteriormente hacemos esa actualización y tenemos una comprobación que cuando esta se hace de forma correcta te da la opción de volver al menú principal ( en la captura se ve un documento con el que yo estaba probando, el correcto es el index.php).

- Al igual que la gente necesita actualizar los datos hay veces que te das de baja de lo que sea y tienes de eliminar los datos, pues nuestro formulario tambien tiene opcion de poder eliminar los datos;
    

- Para eliminar los datos tenemos el documento ‘eliminación.php’;

- ![](https://lh7-us.googleusercontent.com/iRBjZrm9pCYbeSgddhgPSGGZOHcxpmQri81AfzhoEkbjkgal2dkf8j0F_b7x7VBFo6JjWlNDjVEp5-PrUD1neaerzd5lnJjaGbsq0rQDE3Lsw4oi_QL5I2CYUh3fTVHHUPMZ6OrSj4hVOiiDX3wBuRQ)

- En este código podemos ver el enlace con la base de datos y su comprobación y luego vemos como este código es igual que los códigos de actualización ya que estos se rigen por identificadores, también vemos la consulta de eliminación y luego como se ejecuta este y luego el mensaje en pantalla que muestra, cuando se ha realizado de forma correcta te muestra para poder volver a la pantalla principal (index.php).

- Vista gráfica desde el navegador;

- ![](https://lh7-us.googleusercontent.com/9XA4T_HPd9KXIucefKVWkWc1bzzFZ-AJLDu9lTduDAJGBJSP2og4AGYEHoflznapdieT0R9GOiz_25cD_47wE9zm0jjGqvulr8vY35uJddpJYqAcdgXcDUWjlJXmLB5fwrDcUvWgdtaeAg7_DNvBrxU)

  
  
-  Y diría que no me he dejado ningun codigo de funcion para que este formulario funcione de forma correcta 

- Ahora pasamos directamente a la carpeta de css donde tenemos un único documento en el cual veremos la configuración de estilos del formulario y de la pantalla principal, el código que hay podras verlo en el git ya que es un código largo y no me cabe en una sola captura ya que en el mismo código esta el css de diferentes documentos.
## *2.2 Millores* 

- Mejoras que he podido realizar diría que son los enlaces en todas las pantallas finales de las diferentes funciones para poder volver a la pagina principal y observar que la acción que hayamos llevado a cabo tiene un resultado, ya sea añadir,actualizar o eliminar en este caso y por último pero para mi gusto lo más importante el css que he hecho que no se si este puede contar como una mejora pero hacer que se vea mejor que no si no lo llevas a cabo 

- Pero el cuadro de diálogo mediante Javascript antes de eliminar imágenes no lo he podido llevar a cabo ya que me daba errores y para no dejarte este apartado tan en blanco te he dicho las mejoras que he añadido en el código para que se vea y sea algo más funcional.


# ***PART 3: DESENVOLUPAMENT V.0.2***

En este apartado no haremos modificaciones al código, el funcionamiento del CRUDO será el mismo lo que haremos será aprender a utilizar el git

## *3.1 REPOSITORI GIT*

### *3.1.1 CREAR REPOSITORI*

- Creó un repositorio;

![](https://lh7-us.googleusercontent.com/03OEnoSl_NAv0F-J3gqq2miEzuvpuCY9_TaNq8kKo55jpihyMyduCses5Z7p0eXztf1PubJYZvjScIZLUky9S2BEuv0NWCgjZ4QukmzoQpgPeqYMZOBXbet-K_N1Tx5rZxxKlTWvhzN5NRjAjed5AI8)


- Te añadimos como colaborador;

![](https://lh7-us.googleusercontent.com/WHdPl9pf4e88C_JLuWKRIQ9HB1w4zi1SZzSYLVx_9Vmouywv_Xaole0D0TPcH2d207rCQAc1kRfpojvVJ-2U7UGINB_LsqLWaU1loQTFK7_vbE8-S0T7Q2DH0qXMUVXpc6_lUkDQTMgpZOIlv5Czh8Q)

![](https://lh7-us.googleusercontent.com/oweHtM9Ma9pV5qEahXWqc4NPjeOf94vELKRKmn2CKBTam18SWM3XD5viuIUIqd6Wxl44faeLK1_Zx5ojL5EUmJtIzFQlfV-xS8qg-rt6Q8lYrUsF841xr0pW1rXhaItVicwEaN7c_aIWTchbOw1tGjA)

  

### *3.1.2 CLONAR REPOSITORIO*

Una vez tenemos el repertorio creado tenemos dos opciones para clonarlo nosotros lo haremos por ssh ya que es la que él recomienda en las maquinas propias

>[!warning] Recordatorio 
>Yo escogeré la opción de hacerlo por SSH porque mi maquina es personal, esta opción permite crear una clave SSH, para darnos de alta en el GITHUB i autentificarnos de forma automática en nuestra maquina.
	- Para conectarnos a nuestro GitHub realizaremos lo siguiente:
		- En este punto mirar tutorial de como conectar los git con nuestra maquina... tanto para este modulo como para m04.
		- Para clonar el repertorio del GitHub seguiré el siguiente [Tutorial](https://docs.github.com/es/repositories/creating-and-managing-repositories/cloning-a-repository).

- Siguiendo con la explicacion del proyecto generamos una clave token classic, con todo el apartado de repo activado, la clave que solo deja copiar ahora es la siguiente; 

![[Pasted image 20240505170825.png]]

- Ahora comenzamos con la parte de ponerlo en practica, documentando todos los pasos que vayamos realizando;

- Ahora vamos a clonar el repositorio que hemos creado en nuestra maquina local con la siguiente comanda
```Bash
git clone [pones el repositorio].
```

>[!warning] Recordatorio 
>Pequeño inciso! antes de esto tendremos de instalar el paquete de git para que realize la funcion de los comandos que vamos ha realizarle apartir de ahora--> sudo apt install git.

- Cuando sigo los pasos que me dices en el proyecto no se porque llega un punto en el cual funciona mal la conexión con el git. (Voy ha seguir los pasos para conectarme como en el proyecto de M04).

- Prueba que he realizado yo para ver que me funciona en mi ordenador local. 

- Pasos que he seguido para poder hacer la conexión con el git y subo los archivos del proyecto para comprobar que esta forma funciona correctamente.
```bash 
# Clonamos el repositorio;
git clone https://github.com/ErikPlasencia/ProyectoFinal.git 

# Inicializar un nuevo repositorio:
git init

# Agregamos todos los archivos al nuevo repositorio
git add . 
git commit -m "Primer commit"
git remote add origin https://github.com/ErikPlasencia/ProyectoFinal.git
#Para enviar a la rama default (main)
git push origin main
```

En principio con estos pasos seria ya mas que suficiente para poderlo haber hecho de forma correcta.
Desde la maquina del isard me da un error no se porque.
Voy ha seguir estos pasos en mi maquina que se que funcionan de forma correcta.

Para descargar y obtener cambios que hayan habido en el repositorio realizaremos
```bash
git pull origin main
```

Aparte de los ficheros del proyecto tambien subiremos este documento.
