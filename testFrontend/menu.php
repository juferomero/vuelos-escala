        <div class="col-lg-12" style="padding-left: 10%;color: white;background-color: #0073ea;font-size: 20px">
          <h1 class="page-header">Aerolinea-Escalas <?php echo $titulo;?></h1>
        </div>
        <div class="col-md-3" style="padding-left: 0px;padding-top: 5%">
          <div class="panel panel-success" style="margin-top:7px; max-height: 600px; overflow: auto">
            <div class="panel-body">
              <!--<a href="index.php">
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label style="width: 100%;text-align: center;margin-top: 5px">Inicio</label>
                </div>
              </a>
              <div class="col-md-8">&nbsp;</div>
              <a href="reserva.php">
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label style="width: 100%;text-align: center;margin-top: 5px">Buscar Escalas</label>
                </div>
              </a>-->
              <?php
                $host = "sql205.260mb.net";
                $db = "n260m_22004511_prueba_julian";
                $user = "n260m_22004511";
                $pw = "12345678";
                $con = mysql_connect($host,$user,$pw)or die("Problema al conectar con el servidor");
                mysql_set_charset('utf8', $con);
                mysql_select_db($db,$con)or die("Problema al ingresar a la base de datos");
                $sql = mysql_query("SELECT * FROM ciudades");
                $salida = "";
                while ($row = mysql_fetch_array($sql))
                {
                  $salida .= '<option value="'.$row[id].'">'.$row[nombre].'</option>';
                }
                mysql_data_seek($sql, 0);
                mysql_close($sql);
              ?>
              <form action="javascript:void(0)" id="formulario" name="formulario">
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label class="col-md-10" style="margin-top: 5px">Ciudad Origen</label>
                </div>
                <div class="col-md-12" style="border-radius:5px;width:120%;height: 30px;margin-left: -10%;margin-top: 5%">
                  <select class="col-md-12" id="cdd_org" name="cdd_org" onchange="xajax_Buscar(1,xajax.getFormValues('formulario'),0)">
                    <option value="">Seleccione...</option>
                    <?php
                    echo $salida;
                    ?>
                  </select>
                </div>
                <div class="col-md-8">&nbsp;</div>
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label class="col-md-10" style="margin-top: 5px">Ciudad Destino</label>
                </div>
                <div class="col-md-12" style="border-radius:5px;width:120%;height: 30px;margin-left: -10%;margin-top: 5%">
                  <select class="col-md-12" id="cdd_dest" name="cdd_dest" onchange="xajax_Buscar(1,xajax.getFormValues('formulario'),0)">
                    <option value="">Seleccione...</option>
                    <?php
                    echo $salida;
                    ?>
                  </select>
                </div>
                <div class="col-md-8">&nbsp;</div>
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label class="col-md-10" style="margin-top: 5px">Fecha Inicial</label>
                </div>
                <div class="col-md-12" style="border-radius:5px;width:120%;height: 30px;margin-left: -10%;margin-top: 5%">
                  <input type="date" id="fi" name="fi" class="col-md-12">
                </div>
                <div class="col-md-8">&nbsp;</div>
                <div class="col-md-8 bg-primary" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%">
                  <label class="col-md-10" style="margin-top: 5px">Fecha Final</label>
                </div>
                <div class="col-md-12" style="border-radius:5px;width:120%;height: 30px;margin-left: -10%;margin-top: 5%">
                  <input type="date" id="ff" name="ff" class="col-md-12">
                </div>
                <div class="col-md-8">&nbsp;</div>
                <div class="col-md-8 bg-success" style="border-radius:5px;width:80%;height: 30px;margin-left: 15%;margin-rigth: 15%" onclick="xajax_Buscar(0,xajax.getFormValues('formulario'),0)">
                  <label class="col-md-3" style="margin-top: 5px">Buscar</label>
                </div>
                <div class="col-md-8">&nbsp;</div>
              </form>
            </div>
          </div>
        </div>
