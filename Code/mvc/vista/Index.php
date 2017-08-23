<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gespital</title>
    <style>
        form {
            padding-top: 50px;
        }
        .has-error { background: red; color: white; padding: 0.2em; }
        .has-warning { background: blue; color: white; padding: 0.2em; }
    </style>
    <link href="mvc/vista/css/bootstrap.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index">Gespital</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="?pagina=insercion">Añadir autor</a></li>
            <li><a href="?pagina=listar">Listar</a></li>
            <li><a href="?pagina=eliminacion">Eliminar</a></li>
            <li><a href="?pagina=busqueda">Buscar autor por ID</a></li>
            <li><a href="?pagina=modificacion">Modificar</a></li>
        </ul>
        <form class="navbar-form navbar-left">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <h3>Gestion Hospital</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">

            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th class="col-md-1 justificado">Titulo</th>
                    <th class="col-md-1 justificado">Director</th>
                    <th class="col-md-1 justificado">Genero</th>
                    <th class="col-md-5 justificado">Descripción</th>
                    <th class="col-md-1 justificado">Duración</th>
                    <th class="col-md-1 justificado">Year</th>
                    <th class="col-md-1 justificado">Precio</th>
                    <th class="col-md-1 justificado">Imagen</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <form action="insertar" method="post" class="form-horizontal">
                    <tr>
                        <td></td>
                        <td class="col-md-1 justificado"><input id="titulo"
                                                                name="titulo" type="text" placeholder="Titulo"
                                                                class="form-control input-md" required></td>
                        <td class="col-md-1 justificado"><input id="director"
                                                                name="director" type="text" placeholder="Director"
                                                                class="form-control input-md" required></td>
                        <td class="col-md-1 justificado"><select id="genero"
                                                                 name="genero" class="form-control">
                                <option value="1">Acción</option>
                                <option value="2">Animación</option>
                                <option value="3">Ciencia Ficción</option>
                                <option value="4">Comedia</option>
                                <option value="5">Terror</option>
                            </select></td>
                        <td class="col-md-5 justificado"><textarea
                                    class="form-control" id="descripcion" name="descripcion"></textarea></td>
                        <td class="col-md-1 justificado"><input id="duracion"
                                                                name="duracion" type="text" placeholder="Duración"
                                                                class="form-control input-md" required></td>
                        <td class="col-md-1 justificado"><input id="year"
                                                                name="year" type="text" placeholder="Año"
                                                                class="form-control input-md" required></td>
                        <td class="col-md-1 justificado"><input id="precio"
                                                                name="precio" type="text" placeholder="Precio"
                                                                class="form-control input-md" required></td>
                        <td class="col-md-1 justificado"><input id="imagen"
                                                                name="imagen" type="text" placeholder="Imagen"
                                                                class="form-control input-md" required></td>
                        <td><input type="submit" value="Insertar" id="insertar"
                                   name="insertar" class="btn btn-success"></td>
                    </tr>
                </form>
                <!-- <GestoPelicula> -->
                <c:forEach var="pelicula" items="${listaPeliculas}">
                    <tr>
                        <td>${pelicula.idpelicula}</td>
                        <td class="col-md-1 justificado">${pelicula.titulo}</td>
                        <td class="col-md-1 justificado">${pelicula.director}</td>
                        <td class="col-md-1 justificado">${pelicula.genero}</td>
                        <td class="col-md-5 justificado">${pelicula.descripcion}</td>
                        <td class="col-md-1 justificado">${pelicula.duracion}</td>
                        <td class="col-md-1 justificado">${pelicula.year}</td>
                        <td class="col-md-1 justificado">${pelicula.precio}</td>
                        <td class="col-md-1 justificado"><img
                                    src="${pelicula.imagen}" width="110%"></td>
                        <td><button id="eliminar" name="eliminar" value="eliminar"
                                    class="btn btn-danger">
                                <a class="blanco" href="borrar?id=${pelicula.idpelicula}">Eliminar</a>
                            </button></td>
                    </tr>
                </c:forEach>
                </tbody>
            </table>
        </div>
    </div>


</body>
</html>