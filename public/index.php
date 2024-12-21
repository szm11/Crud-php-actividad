<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database/bootstrap.php';


$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = rtrim($uri, '/') . '/';

if (strpos($uri, 'api/') === 0) {
        
    $_SERVER['REQUEST_URI'] = '/' . substr($uri, 4); 
    require __DIR__ . '/../api/routes.php';

    
} else {
    
  echo <<<HTML
   <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Proyectos</title>
                    <link rel="stylesheet" href="./recursos/css/style.css">
                </head>
                <body>
                    
                





                    
                    
                   <div style="display:flex;  width:100%; justify-content: space-around; ">
                   
                    <div>
                    <h1 style="display:flex;">Ver Rutas</h1>

                    <input type="text" id="searchInput" placeholder="Buscar Rutas..." style="margin:10px; width: 30%;">
                        
                        <table id="RutasTable" style="width:55%;margin:10px;">

                            <thead>
                                <tr>
                                    
                                    <th>ID</th>
                                    <th>capacidad</th>
                                    <th>estado</th>
                                    <th>kilometraje</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los Rutas -->
                            </tbody>
                        </table>
                    </div>

                    <form id="RutasForm" style="width:40%;margin:10px;"> 
                        <h1>Crear Ruta</h1>
                        <input type="text" name="capacidad" placeholder="capacidad del Ruta" required>
                        <input type="text" name="estado" placeholder="estado del Ruta" required>
                        <input type="text" name="kilometraje" placeholder="kilometraje del Ruta">
                        <button type="submit" id="insertButtonRutas">Insertar Ruta</button>
                        <button type="button" id="updateButtonRutas" style="display:none;">Actualizar Ruta</button>
                        <button type="button" onclick="clearFormRutas()">Limpiar</button>
                    </form>
                   </div>

                   <hr>


                   <div style="display:flex; width:100%;    justify-content: space-around;">
                    <div>
                   <h1 style="display:flex;">Ver Contratos</h1>

                        <input type="text" id="searchInputContratos" placeholder="Buscar Contratos..." style="margin:10px; width: 30%;">
                        
                        <table id="ContratosTable" style="width:55%;margin:10px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Modalidad</th>
                                    <th>Tarifa</th>
                                    <th>Ruta ID</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los Contratos -->
                            </tbody>
                        </table>
                    </div>

                    <form id="ContratosForm" style="width:40%;margin:10px;"> 
                        <h1>Crear Contrato</h1>
                        <input type="date" name="fecha_inicio" placeholder="Fecha de Inicio" required>
                        <input type="date" name="fecha_fin" placeholder="Fecha de Fin" required>
                        <input type="text" name="modalidad" placeholder="Modalidad" required>
                        <input type="number" name="tarifa" placeholder="Tarifa" required>
                        <input type="number" name="ruta_id" placeholder="Ruta ID" required>
                        <button type="submit" id="insertButtonContratos">Insertar Contrato</button>
                        <button type="button" id="updateButtonContratos" style="display:none;">Actualizar Contrato</button>
                        <button type="button" onclick="clearFormContratos()">Limpiar</button>
                    </form>
                   </div>




          


                 <script src="./recursos/js/rutas.js"></script>
                 <script src="./recursos/js/contratos.js"></script>

                </body>
                </html>
  
  HTML;
}
