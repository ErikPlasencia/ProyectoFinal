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
git push origin master
```

En principio con estos pasos seria ya mas que suficiente para poderlo haber hecho de forma correcta.
Desde la maquina del isard me da un error no se porque.
Voy ha seguir estos pasos en mi maquina que se que funcionan de forma correcta.

Para descargar y obtener cambios que hayan habido en el repositorio realizaremos
```bash
git pull origin master
```

Aparte de los ficheros del proyecto también subiremos este documento.


### *3.1.3 Commits*

- Esta funcion **commit** funciona para dar confirmación a unos cambios específicos en nuestro código fuente, este se realizara sobre nuestro repositorio local.
- El procedimiento usual para genera un commit es el siguiente:
	- git add
	- git status 
	- git commit 
- Estos como ya he dicho se generan y se guardan en la maquina local luego para poder ver el historial de estos se puede ver utilizando git log.
- Para enviarlo al repositorio remoto tenemos de realizar el git push 

La parte de practica la he hecho pero no puedo acceder a documentarlo ya que lo he hecho por el git  y luego en mi terminal solo he realizado un git pull para descargarme el readme.md que he hecho.

### *3.1.2 Fitxer .gitignore*

Esto es porque GIT permite ignorar fitxeros para no incluirlo en un commit, esto significa que nunca serán subidos en el repositorio. 

**VAMOS A PONERLO EN PRACTICA**
- Crea un nuevo directorio que se llame "config"
	- ![[Pasted image 20240509191246.png]]
	- Crea un nuevo directorio que se llame "database.php" dentro de este nuevo directorio
	- ![[Pasted image 20240509191506.png]]
	- Revisa el listado de fitxeros marcados por guardar los cambio con git status 
	- Crea el fitxero .gitignore en la raíz del repositorio 
	- ![[Pasted image 20240509192028.png]]
	- Comproveu que el directori config ni els fitxers interiors apareixen com a canvi per “cometre”. En cas contrari, probablement, teniu l’aplicació PHP dins d’un directori intermig i no a l’arrel.
	- Feu un commit NOMÉS del fitxer .gitignore amb un comentari associat
		- Lo voy ha hacer todo junto:
		- 
		- ![[Pasted image 20240509192543.png]]
		- ![[Pasted image 20240509192601.png]]
		- Podemos ver como se ha subido el .gitignore.php pero no la carpeta config
		- ![[Pasted image 20240509192641.png]]

### *3.1.5 Branques i etiquetes*

La política de ramas y etiquetas será sencilla. Al inicio del desarrollo de cada versión del proyecto, como por ejemplo «b0.2», crearemos una nueva rama. Una vez que el código esté completo y probado, fusionaremos la rama actual con la rama principal, ya sea «master» o «main», y luego crearemos una etiqueta de versión en la rama principal, por ejemplo «0.1».  
En caso de olvidar subir algún cambio después de fusionar una rama de versión a la rama «master» y crear la etiqueta correspondiente , podemos hacer un commit directamente en la rama «master» y crear una subetiqueta, por ejemplo «0.2.1». Si nos olvidamos de algún cambio nuevamente, podemos repetir el proceso con un nuevo commit y una nueva subetiqueta, como por ejemplo «0.2.2», y así sucesivamente.

![](https://lh7-us.googleusercontent.com/3gD4NK7qJgCaqIlCtR_PAA2B4nZgYT67nSLab8UlRJA2J6EsA1-zM3ReIol_1tn8VyRCD72VsRkkIc0buuLpO1jZciZEqhkCUwkWNRWKreppPdwCm5RGInXZEsSCKiJ_g8wk2Mt6ULgNTGnJrHzJi0M)

  
### *3.1.5.1 Branca master*

Por defecto, al crear un nuevo repositorio Git, se genera una rama principal llamada «master» . Las ramas son «bifurcaciones» del estado actual del código que permiten desarrollar nuevo código en paralelo sin afectar el código actual. Una de las mayores utilidades del uso de ramas es evitar pisarnos el trabajo cuando trabajamos en equipo.

- ![[Pasted image 20240509193231.png]]
### *3.1.5.2 Subir y bajar cambios*

Normalmente cuando hacemos estas conexiones es porque somos mas de una persona desarollando el proyecto asi que tenemos de saber subir los archivos;

```bash
git push origin BRANCA
```

Pero tambien tenemos de saber descargarnos los cambios nuevos que hayana en el repositorio remoto a nuestra terminal para actualizar nuestros codigos locales;

```bash
git pull origin BRANCA
```

--> LA PRACTICA ESTA NO SIRVE PARA NADA Y YA HE PRACTICADO CON EL GIT EN EL PROYECTO DE M04 ASI QUE VOT HA PASAR A LA SIGUIENTE FASE.

La utilidad que tiene el push y el pull en la vida real es importantísima ya que es un medio que te permite mantener tus códigos actualizados descargando y subiendo archivos de repositorios remotos.

### *3.1.5.3 Etiqueta v0.1*

Estas sirven para marcar el estado de un código en un momento concreto, básicamente darle un nombre a un commit de una rama en concreto atreves del siguiente comando;

```bash
git tag ETIQUETA    
```

Esta misma tambien te permite ver las etiquetas creadas con;

```bash
git tag -l
```

O eliminar estas con la opcion -d;

```bash
git tag -d ETIQUETA 
```

>[!warning] Recordatorio 
> Quan hem creat etiquetes des de la nostra màquina local i volem pujar-les al repositori remot, cal afegir l’opció --tags a la comanda git push

**VAMOS A PONERLO EN PRACTICA**
- Los pasos que tenemos de seguir estan en el documento del moodle, aqui estan los resultados;
![[Pasted image 20240509194942.png]]

- Etiquetas que tenemos despues de este push en nuestro repositorio del git; 
![[Pasted image 20240509195050.png]]

### *3.1.5.4 Branca b0.2*

Podemos crear una nueva rama, a partir de la actual, con el comando;

```bash
git branch BRANCA
```
  
El mismo pedido también permite listar las ramas creadas con la opción -l:

```bash
git branch -l
```

O eliminar las ramas creadas con la opción -d:

```bash
  git branch -d BRANCA
```

Cuando tenemos más de una rama, podemos cambiar de una a otra con el comando

```bash
git checkout BRANCA
```

Si queremos crear una nueva rama y acceder de repente, podemos utilizar el mismo pedido con la opción -b:

```bash
git checkout -b BRANCA
```

**VAMOS A PONERLO EN PRACTICA**

1. Assegureu-vos que sou a la branca principal (“master” o “main”)
    - **![](https://lh7-us.googleusercontent.com/tyJTAMSCjPuQ64furErxjNpRvYv5PjQACkAHZkXi3LAPTYuRjBmSVq4go2RExUmNptmlVaDK5Pg6t4jIqy7-8dYp1gQQADX9LZy89iT3xWadILfK79deWgifSNyFAwhyUTnP8uM-68yiw99POVDs7UI)**
2. Creeu una nova branca “b0.2” a partir de la branca principal
    - **![](https://lh7-us.googleusercontent.com/-4W2rhuSXMnQfb_GfdKXLvEi8kk8dvTc4KQ4qU4Vg_uSOWs6asGdoj2uQnhiI_l4jfmHPVurxTmi6VlCy5Ud41zioa5l1o4mulRzfORgsCbvPSaG0QG4r5uKOAuXmjqc-sm9y6NMRa0lnUYDdpX2unU)**
3. Canvieu a la nova branca “b0.2”
    - **![](https://lh7-us.googleusercontent.com/mpzAmubecqiHAnI_Q1N8S3rzKAVFnhkCIEE6uZIkBdU8QvCh5qZVCFDyzQhxQACo0etGNyWzuxnBwh0v5M-9-s4mIJKpO5-WIzhQIqN87ZzoMl8dxsso_ryKboX3kq6xLaSZQgrdGXJRSPTf2XOv4bA)**
4. Editeu el fitxer README.md per afegir una nova línia amb la versió actual del projecte
    - **![](https://lh7-us.googleusercontent.com/_Rg7dt1q2WihPKQ_EEYK5EVk8YJF-ZHuVL5EWHH9EWWo9UglHRihb5wJotEj16VUq7NLFtvSogLZrv2TM5F25EZLEZupqYekr3DmFLD_dVGCYjFUaF2K9THZ_DUrdWDHFf7z0WOjLqoOSDH6rSuvLsY)**
5. Feu un commit dels canvis realitzats al fitxer README.md
    - **![](https://lh7-us.googleusercontent.com/odO7inQfmNTZHU9vzegpxVF4zwujNOFtriIropOrw2LWN80AZKgvRtPZ3Vxt2eaatytXVsswX0HexqIFt-kx7KN8qxlhI9Wh49VDBy_lIibOk7zDHBnD104FGP55HWnbY_Uql7Ot0BEmPeJdHFkCfr0)**
6. Pugeu NOMÉS els canvis de la branca “b0.2” al repositori remot
	- **![](https://lh7-us.googleusercontent.com/COgfgoG9EvEJqZixDW4S2RyZbpUU99Txq1mLZb-O5_tuWJ-o4H4S_XUC6fnJAofdjNKgjFp8sqYQELVCRxEVOKqJ4dfybG1eP4V5KEKFwSD4b9yAmpa8gxePqhQi4aml4v0KAV1fl5gF5NrMDjbMciM)**

- Accediu a [GitHub](https://github.com/) i documenteu les branques actuals del repositori;
	- Cuando accedo al github lo primero que veo esque hay otra rama y que apartte logicamente por los pasos del ejercicio es la que tenemos activa ahora mismo; **![](https://lh7-us.googleusercontent.com/_n1G4EYZpO3frcykJoOq9GqMmgqh8v65yZI3srhtZFgfXwdu8futC-J-G5hDDdrelzNaoFNpNPCqknuYI_--S4zPw1sP2DdKv8jsOv4jGyhhPnJm5NR6VcoNAilY9bSe1KYdv4hAR2VB5cGQ4uhe7wM)**
	- Aparte de esto cuando miro lo que esta rama tiene lo mismo que la otra pero que tiene mas actualizado el Readme.md que no la rama principal; 
	- **![](https://lh7-us.googleusercontent.com/jDkR4wcp3WlDeS6IoDrEI2JylHZT2PP2fGiOvvTVT4Js0bCGtI3X_o9CkR8ymJYMqFnbGcqsL26HisALRNYixIInSJWsGMo1AQNVna6ItalstAJQM3qblyW8Mm2C2mqLxroTygb1J2VAeBuIcTuQwkk)**
### *3.1.5.4 Barrejar Ramas*

En principio tendríamos de seguir desarrollando la rama que acabamos de crear y despues fusionarlas pero para practicar lo realizaremos ahora con el comando;

```
git merge 
```

**VAMOS A PRACTICAR**


1. Canvieu a la branca principal (“master” o “main”)
    - **![](https://lh7-us.googleusercontent.com/bm5b58RcYL3893S8DtI88v1aDPlrcRYesnZcJq1OfIIADDdsRtSPOzrlWmibUH_XyeNkdFy93U83thamisG9ws53uSyjPt6DhHSHBX3V4LApKAwzxlhHcM4qHsB_NbNEMjpGbzCIZnPmbGFUh3c3Lrc)**
2. Assegureu-vos que sou a la branca principal
    - **![](https://lh7-us.googleusercontent.com/kQgBIAJYV2Ek64v4A0vav4sM7vkvT5lxuUEj19cK2Zd1dqdcjB35ZA27qUb_A02mU7oGcMpcV--TAPcM5BKlTcqNW3auH1VlRR8wj70kdsZMQUfjY5A3LpjGGZIWpmTShuOZBejqDAq3bya-8DTUhLk)**
3. Reviseu l’històric de commits realitzats
    - **![](https://lh7-us.googleusercontent.com/E2uhgXGru7xXiTpqLu0vCL8pDPCemYGVKZLF5V2obD7z_N54hJf1-mSAIfztSLqZUjiIYe8aCR24SJRxD-IBXI-J6lDyzr3iNJTW2SqNc2JFNz9kQTrB6bFKjPSrL3xUrQWotCBvsrdvC0h2EqFiSBM)**
4. Barregeu la branca “b0.2” a la branca principal amb la comanda git merge;
    - **![](https://lh7-us.googleusercontent.com/7_sLZnLkcrd5QLHTy3D69CtiovB5aG2hG4J5M2TiMA--KLkNgZ8xv0FVbIPH1hpaTVjTGOw8TQ_j89Vdwy-2b0xL_jFdYQjdBdsWwC23hnbAHXSde7tmX8JZoYlPKpNk1DlOP67p5jqFg0tSpQlZ5ec)**
5. Reviseu l’històric de commits realitzats (veureu un nou commit!)
    - No me acorde de hacerle captura de pantalla 
6. Pugeu els canvis al repositori remot
    - **![](https://lh7-us.googleusercontent.com/zu7BTAez0HC1mD2AHnki8cmwyY3ckbZqPSJdY56Z1xFAFkmpBuuyd_ABsd2akUvja_C80aeOGW3EYR6PYZVWwz18d7fai4R5yANa3b9Nnx6ktPAZLv2wqzI_ms4YKyMbVqKahB7BRaaMyM1Qnv9bfv4)**
7. Reviseu l’històric de commits realitzats amb les següents opcions:
    - **![](https://lh7-us.googleusercontent.com/MBzmFDnhAN-T8rEP00TOfua0VvLKn7_XzFKHufuDcH-XxXdpu3HCeqscWByBF1TU_LndV4fq_prjeAYTMTcTY0BakzLPaisdMKQuiq-UxneniH7Sg5Mp7mOvbzvQ7JHaBi3Gmh5UH3tSy-8-8XJzuBA)**


## *3.2 DOCUMENTACION DEL CODIGO*

- Antes de continuar cambia a la rama "b0.2" del repositorio para guardar los cambios de esa rama 


### *3.2.1 Generar Documentación*

La herramienta de ==phpDocumentor==  nos permitirá generar documentación del código desarrollado apartir de comentario que estén incluidos en el propio código, vamos a probarlo con los siguientes pasos;
- Consulta la guía de instalación de este i descarga la versión ejecutable de la herramienta raíz. (será fichero PHAR) --> Toda la información de la instalación [aqui](https://docs.phpdoc.org/guide/getting-started/installing.html#installation)
- Pasos que he seguido para poder instalarlo:

1. Instala Phive siguiendo las instrucciones en su sitio web: [https://phar.io/](https://phar.io/)
2. Una vez instalado Phive, ejecuta el siguiente comando para instalar PHP Documentor:

Open In EditorEditCopy code

`1$ phive install phpDocumentor`

Después de ejecutar este comando, PHP Documentor se instalará y se podrá ejecutar directamente.

Alternativamente, puedes descargar el archivo PHAR más reciente desde [https://phpdoc.org/phpDocumentor.phar](https://phpdoc.org/phpDocumentor.phar) o una versión específica desde [https://github.com/phpDocumentor/phpDocumentor/releases](https://github.com/phpDocumentor/phpDocumentor/releases).

El archivo PHAR se puede usar invocando PHP directamente y proporcionando el archivo PHAR como un parámetro:

Open In EditorEditCopy code

`1$ php phpDocumentor.phar run -d . -t docs/api`

En Mac y Linux, puedes marcarlo como ejecutable y moverlo a tu carpeta bin:

Open In EditorEditCopy code

`1$ chmod +x phpDocumentor.phar 2$ mv phpDocumentor.phar /usr/local/bin/phpDocumentor`

Después de eso, puedes ejecutarlo globalmente:

Open In EditorEditCopy code

`1$ phpDocumentor run -d . -t docs/api`

**

- No funciona esto (no me he acordado de poner capturas de la instalacion pero intentando que funcionase acabe poniendo los siguientes comando que me dijo el chat gpt haber si de esa manera conseguia que me funcionase).  
      
    
- ![](https://lh7-us.googleusercontent.com/JT3zuCSxMQs2KBdnZTYOgDDtYApPbGyeSQRWD_ukDHcQqrCMZCHY-Hh1R5AK7ia8c1txYZWvNQ5IAJCJWbXpCDZI_mbymd__jo0fo66ha-6qYKMIgKaDSqxSQnuQvas6S5Xmz5u5WtyVcW-nhMLneYc)
    

### *3.2.2 Editar .gitignore*

  

- En este apartado no he movido nada ya que no me funciona el phpDocumentor.
    

  

### *3.2.3 Actualizar repositorio*

- Este apartado si que te lo puedo hacer haciendo los pasos necesarios que hacen falta para subir cosas al github en concreto en  la rama ‘b0.2’:
    

  
![](https://lh7-us.googleusercontent.com/2A-VJbm1XbeftG5E0_Fkr7MiQ_MOyA8k5EVl40iuBBuJafRMV0YKAH1yD7hVnjLRu1KwM0A7YvtMS4nEWhI_9COPrJKd9JqzpYquf0gGuUCZgcoivSF421ezDesWD85dVc_lRRV8hgwXLcLSfr5KfTk)

  

Aqui he seguido todos los pasos que tendria de hacer si me hubiese funcionado pero la unica diferenia es que cuando hago el push sale que esta al dia porque no ha habido ningun tipo de cambio en ningun archivo que tenga de subir al github ya que no me funcionaba el phpdocumentor ese.

## *4.- Desenvolvimiento v1.0* 

### *4.1 Modificar la BD*

- Llegados a este punto tengo de crear dos tablas relacionales más y luego la tabla de usuarios también. 
    
- La segunda tabla que creo es una tabla llamada jugadores que contiene lo siguiente;
    

![](https://lh7-us.googleusercontent.com/FDEooiwRyAacyadRUwtGF02kvVu2kYOW8F_bg0xbEsP5OWC7rYSa1XJ78lR9aJs3y0utEVxtWUbJDiq2oX0g3pjDYTC079TQ4bfMbxUlqSb176gE1alR4lSXlQzYsKFeowa2zGwgEoYdo33LXphBsRY)

  

- La tercera tabla que creo es una tabla llamada
    

![](https://lh7-us.googleusercontent.com/Uvly0TEaPn7_tmy6AECfJ2RY8yGVz7JEPTf0C7CzUye81xEYDI3fnCqJra9mckfwwG0zGFhWDXJpbA64bdHE5FbmagaZ4lL9WrdF34IxkpWB7-0h533kp3YxItEkZxHzaP2j3zzYWf8W9_HoLVk9MFk)

  

- Y la última tabla es la de usuarios que pedía el apartado;
    

![](https://lh7-us.googleusercontent.com/j5v9fLfK5WUCGtItoW0WkTJboIroJjcwacgQusdByULYMznPhTZTbcGhvSlOhxNLXqm-eDRo6Jv4zrmVi683ORoRkK1ilRWZm7484uqCFV4W3NCbAqWeG8tI5pWIknRJv0h5F38zyrsvqQGx9MyK2UQ)

  
  
  
