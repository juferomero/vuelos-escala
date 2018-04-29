<?php
  function Buscar($tipo,$form,$id)
  {
    error_reporting(E_ALL ^ E_NOTICE);
	$host = "sql205.260mb.net";
	$db = "n260m_22004511_prueba_julian";
	$user = "n260m_22004511";
	$pw = "12345678";
	$con = mysql_connect($host,$user,$pw)or die("Problema al conectar con el servidor");
	mysql_set_charset('utf8', $con);
	mysql_select_db($db,$con)or die("Problema al ingresar a la base de datos");
    global $respuesta;
	if ($tipo==2)
	{
	  $sql_esc = mysql_query("SELECT f.fecha_salida, f.fecha_llegada, g.nombre AS ciudad_origen_escala, h.nombre AS ciudad_destino_escala FROM escalas AS f LEFT JOIN ciudades AS g ON g.id=f.ciudad_id_origen LEFT JOIN ciudades AS h ON h.id=f.ciudad_id_escala WHERE f.trayecto_id=".$id." ORDER BY f.fecha_salida");
	  $trayecto = '       <div class="panel-body jfrrtbldes2">
						    <table class="display" cellspacing="0" width="90%">
						      <thead>
						        <tr>
						          <th class="jfrrtblbrd" style="text-align: center">Fecha y Hora Salida</th>
						          <th class="jfrrtblbrd" style="text-align: center">Ciudad Origen</th>
						          <th class="jfrrtblbrd" style="text-align: center">Ciudad Destino</th>
						        </tr>
						      </thead>
						      <tbody>';
	  while ($row_esc=mysql_fetch_array($sql_esc))
	  {
		$trayecto .= '          <tr>
						          <td class="jfrrtblbrd" style="text-align: center">'.$row_esc['fecha_salida'].'</td>
						          <td class="jfrrtblbrd" style="text-align: center">'.$row_esc['ciudad_origen_escala'].'</td>
						          <td class="jfrrtblbrd" style="text-align: center">'.$row_esc['ciudad_destino_escala'].'</td>
						        </tr>';
	  }
	  mysql_data_seek($sql_esc, 0);
	  mysql_close($sql_esc);
	  $trayecto .= '          </tbody>
						    </table>
						  </div>';
	  $respuesta->addAssign("Gestion2","innerHTML",$trayecto);
	}
	else
	{
	  $add_sql = "";
      $fi = $form["fi"];
      $ff = $form["ff"];
	  if ($fi=="" || $fi=="0" || $ff=="0" || $ff=="")
	  {
        $fi = date('Y-m-01');
        $ff = date('Y-m-d');
	  }
	  if ($tipo==1)
	  {
	    $cdd_org = $form["cdd_org"];
	    $cdd_dest = $form["cdd_dest"];
	    /*if ($cdd_org!="" || $cdd_dest!="")
		  $add_sql = "WHERE ";*/
	    if ($cdd_org!="")
		  $add_sql .= "a.ciudad_origen_id=".$cdd_org." AND ";
	    /*if ($cdd_org!="" && $cdd_dest!="")
		  $add_sql .= "AND ";*/
	    if ($cdd_dest!="")
		  $add_sql .= "a.ciudad_destino_id=".$cdd_dest." AND ";
	  }
	  $sql = mysql_query("SELECT a.id_trayectos, a.fecha_salida, a.duracion, b.nombre AS ciudad_origen, c.nombre AS ciudad_destino, e.denominacion FROM trayectos AS a INNER JOIN ciudades AS b ON a.ciudad_origen_id=b.id INNER JOIN ciudades AS c ON a.ciudad_destino_id=c.id INNER JOIN categorias_trayectos AS d ON a.id_trayectos=d.trayectos_id INNER JOIN categorias AS e ON d.categorias_id=e.id WHERE ".$add_sql." DATE(a.fecha_salida) BETWEEN '$fi' AND '$ff' ORDER BY a.id_trayectos");
      if (mysql_num_rows($sql)==0)
	    $salida = '<h3 class="text-center text-success">Sin resultados</h3>';
      else
      {
        $salida = '		  <div class="row">
						    <div>
							  <div class="panel-body jfrrtbldes">
							    <table id="tabla_u" class="display" cellspacing="0" width="100%">
							      <thead>
							        <tr>
							          <th class="jfrrtblbrd" style="text-align: center">Fecha y Hora Salida</th>
							          <th class="jfrrtblbrd" style="text-align: center">Duracion</th>
							          <th class="jfrrtblbrd" style="text-align: center">Ciudad Origen</th>
							          <th class="jfrrtblbrd" style="text-align: center">Trayecto</th>
							          <th class="jfrrtblbrd" style="text-align: center">Ciudad Destino</th>
							          <th class="jfrrtblbrd" style="text-align: center">Categoria</th>
							        </tr>
							      </thead>
							      <tbody>';
        while ($row=mysql_fetch_array($sql))
        {
		  $sql_esc = mysql_query("SELECT f.fecha_salida, f.fecha_llegada, g.nombre AS ciudad_origen_escala, h.nombre AS ciudad_destino_escala FROM escalas AS f LEFT JOIN ciudades AS g ON g.id=f.ciudad_id_origen LEFT JOIN ciudades AS h ON h.id=f.ciudad_id_escala WHERE f.trayecto_id=".$row['id_trayectos']." ORDER BY f.fecha_salida");
		  if (mysql_num_rows($sql_esc)==0)
		    $trayecto = "DIRECTO";
		  else
		    $trayecto = '<div class="bg-primary" onclick="xajax_Buscar(2,0,'.$row['id_trayectos'].')">ESCALA</div>';
		  mysql_close($sql_esc);
          $salida .= '              <tr>
							          <td class="jfrrtblbrd" style="text-align: center">'.$row['fecha_salida'].'</td>
							          <td class="jfrrtblbrd" style="text-align: center">'.$row['duracion'].'</td>
							          <td class="jfrrtblbrd" style="text-align: center">'.$row['ciudad_origen'].'</td>
							          <td class="jfrrtblbrd" style="text-align: center">'.$trayecto.'</td>
							          <td class="jfrrtblbrd" style="text-align: center">'.$row['ciudad_destino'].'</td>
							          <td class="jfrrtblbrd" style="text-align: center">'.$row['denominacion'].'</td>
							        </tr>';
        }
	    mysql_data_seek($sql, 0);
	    mysql_close($sql);
        $salida .= '			  </tbody>
							    </table>
							  </div>
							</div>
						  </div>';
	  }
	  $respuesta->addAssign("Gestion","innerHTML",$salida);
	  $respuesta->addAssign("Gestion2","innerHTML","");
    }
    return $respuesta;//REGRESAR CONTENIDO DE VARIABLE *salida*
  }
?>
