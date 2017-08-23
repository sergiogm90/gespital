<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php $val = Validacion::getInstance(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GESTION DE LA BASE DE DATOS DE USUARIOS</title>
        <style>
            form {
                padding-top: 50px;
            }
            .has-error { background: red; color: white; padding: 0.2em; }
            .has-warning { background: blue; color: white; padding: 0.2em; }
        </style>
        <link href="mvc/vista/comun.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div id="menu">
        <ul>
            <li><a href="?pagina=menu">Inicio</a></li>
            <li><a href="?pagina=insercion">Añadir autor</a></li>
            <li><a href="?pagina=listar">Listar</a></li>
            <li><a href="?pagina=eliminacion">Eliminar</a></li>
            <li><a href="?pagina=busqueda">Buscar autor por ID</a></li>
            <li><a href="?pagina=modificacion">Modificar</a></li>
        </ul>
    </div>
        <div class="container">
            <form action="index.php?pagina=modificacion" method="post">
                <h1>GESTION DE LA BASE DE DATOS DE USUARIOS. MODIFICAR</h1>
                <h2>Introduzca el ID del usuario y pulse el botón Buscar</h2>
                {{errores}}
                <div>
                    <label class=" {{class-id}}" for="id">Id</label>
                    <input type="text" id="id" name="id"
                           value='<?php echo $val->restoreValue('id'); ?>' >
                    <span>{{war-id}}</span>
                </div>
                <br>
                <div>
                    <button type="submit" name="modificacion">Buscar </i></button>
                </div>
            </form>
        </div>
    </body>
</html>
