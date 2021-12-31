Instalamos :
<li>Laravel: <a href="https://laravel.com/docs/8.x/installation">Instalación</a></li>
<li>Composer: <a href="https://getcomposer.org/download/">Instalación</a> </li>

Comandos de funcionamiento:
<li>
Primero lanzamos el comando composer install, para la instalación de las dependencias.
</li>
<li>
Desplegamos apache y mysql para el funcionamiento del proyecto en local.
</li>
<li>
Lanzamos las migraciones y los seeders, para obtener las tablas y los datos de la base de datos.
<ul>
    <li>Seeders: <a href="https://laravel.com/docs/8.x/seeding">Seeder</a> </li>
    <li>Migration: <a href="https://laravel.com/docs/8.x/migrations">Seeder</a> </li>
</ul>
</li>
<br>
<li>
Para entrar en la plataforma hay que crear un usuarios con email = 'admin@gmail.com', que sera el administrador.
<p>Después nos iremos al apartado de roles y crearemos un rol cliente. Donde solo tenga los permisos (ver-film y ver-my-films)</p>
</li>
<br>
<li>
Todos los usuarios que se registren desde la aplicación tendrán rol de cliente, creado anteriormente desde la vista de roles.
</li>
