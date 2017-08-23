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
<div>
    <form action="index.php?pagina=insercion" method="post">
        <h1>GESTION DE LA BASE DE DATOS DE USUARIOS. INSERTAR</h1>
        {{errores}}
        <div>
            <label class=" {{class-nombre}}" for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"
                   value='<?php echo $val->restoreValue('nombre'); ?>' >
            <span>{{war-nombre}}</span>
        </div>
        <div>
            <label class=" {{class-apellidos}}" for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos"
                   value='<?php echo $val->restoreValue('apellidos'); ?>' >
            <span>{{war-apellidos}}</span>
        </div>

        <br>
        <div>
            <button type="submit" name="insercion">Insertar </i></button>
        </div>
    </form>
</div>
</body>
</html>
  
