<?php
  //INICIO XAJAX
  error_reporting(E_ALL ^ E_NOTICE);
  global $respuesta;
  //INICIO CONEXION XAJAX
  require ('nxajax/xajax.inc.php');
  $xajax = new xajax();
  $respuesta = new xajaxResponse();
  //FIN CONEXION XAJAX
  include_once('testBackend/Buscar.php');//LLAMADO DE LA CLASE PARA OBTENER USUARIOS
  $xajax->registerFunction("Buscar");
  $xajax->processRequests();
  //FIN XAJAX
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      $titulo = "Prueba Julian";
      include ('testFrontend/head.php');
      $xajax->printJavascript('nxajax'); //INVOCACION XAJAX MEDIANTE JAVASCRIPT
    ?>
  </head>
  <body onLoad="xajax_Buscar(0,0)">
    <div class="col-lg-12">
      <div class="row">
        <?php
          include ('testFrontend/menu.php');
        ?>
        <div class="col-lg-8" style="padding-top: 5%">
          <div id="page-wrapper" style="min-height: 735px;">
            <div class="col-lg-12">
              <div class="col-lg-12" id="ver"></div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="panel panel-info">
                    <div class="panel-body" id="Gestion"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>