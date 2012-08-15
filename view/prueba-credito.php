<?php
if (isset($_POST['f_age']))
{
	$credito 	= new CreditosValue();
	echo '<h1>Valores</h1>';
	foreach ($_POST as $key=>$value)
	{
		$explode = explode("_", $key);
		if ($explode[0] == 'f')
			$credito->addFilter($explode[1], $value);
	
		echo '<li>'.$explode[1].':'.$value.'</li>';
	}
	$resultados	= $credito->getWithFilters();
	echo '<hr>';
	echo '<h1>Productos validos para consulta:</h1><ul>';
	while($row = mysql_fetch_assoc($resultados["query"]))
		echo '<li>'.$row["credito_id"].'</li>';
	echo '</ul>';
	echo '<hr />';
	echo '<h1>Apertura</h1>';
	$credito->Apertura();
	echo '<hr />';
	echo '<h1>Costo</h1>';	
	$credito->Costo();
	echo '<hr />';
	echo '<h1>Facilidades de Pago</h1>';	
	$credito->Facilidades();	
	echo '<hr />';
	echo '<h1>Proteccion</h1>';	
	$credito->Proteccion();		
}
else 
{
?>
    <hr />
    <form action="<?php echo APPLICATION_URL?>prueba-credito.html" method="post">
        Edad: <input type="text" name="f_age" value="0" /><br>
        Ingreso: <input type="text" name="f_income" value="0" /><br>
        Ingreso Familiar: <select name="f_family"><option value="No">No</option><option value="Si">Si</option></select> 
        ¿Cuanto?: <input type="text" name="f_family-income" value="0" /><br>
        Tiene historia crediticia: <select ="f_credit-history"><option value="No">No</option><option value="Si">Si</option></select> <br>
        Ocupación: <select name="f_occupation">
            <option value="1">Pensionado</option>
            <option value="2">Independiente</option>
            <option value="3">Estudiante</option>
            <option value="4">Rentista</option>        
            <option value="5">Empleado</option>                
        </select> <br>
        Es: <select name="f_occupation-extra">
            <option value="1">Ninguno</option>
            <option value="2">Medico</option>
            <option value="3">Empleado Publico</option>
        </select> <br>
        
        Plazo: <input type="text" name="f_term" value="0" /><br>
        Monto: <input type="text" name="f_loan" value="0" /><br>
        Educación: <select ="f_study-level">
            <option value="1">Once</option>
            <option value="2">Tecnico</option>
            <option value="3">Profesional</option>
            <option value="4">Posgrado</option>        
            <option value="5">Maestria</option>                
        </select> <br>    
        Tiene reportes a centrales de riesgo: <select name="f_credit-history"><option value="No">No</option><option value="Si">Si</option></select> <br>
        Tiene un codeudor?: <select name="f_codeudor"><option value="No">No</option><option value="Si">Si</option></select> <br>
        Tiempo de experiencia crediticia: <input type="text" name="f_credit-time" value="0" /><br>
        Genero: <select name="f_gender"><option value="Hombre">Hombre</option><option value="Mujer">Mujer</option></select> <br>
        Canal por el que quiere pagar: <select name="f_channel-1"><option value="Oficina">Oficina</option><option value="Cajero">Cajero</option><option value="Cnb">Cnb</option><option value="Internet">Internet</option><option value="Audiolinea">Audiolinea</option></select> <br>
        Canal 2 por el que quiere pagar: <select name="f_channel-2"><option value="Oficina">Oficina</option><option value="Cajero">Cajero</option><option value="Cnb">Cnb</option><option value="Internet">Internet</option><option value="Audiolinea">Audiolinea</option></select> <br>
        Canal 3 por el que quiere pagar: <select name="f_channel-3"><option value="Oficina">Oficina</option><option value="Cajero">Cajero</option><option value="Cnb">Cnb</option><option value="Internet">Internet</option><option value="Audiolinea">Audiolinea</option></select> <br>
        <input type="submit"> 
    </form>
<?php
} 
?>