<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de usuarios</title>
        <style>
            dl {
                padding-top: 50px;
            }
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
        <h1>Listado de usuarios</h1>
        {{listado}}
        <br>
    </body>

</html>