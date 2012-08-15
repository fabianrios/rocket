<?php
if (isset($_POST['f-bien']))
{
	$sueno 	= new Sueno();	
	echo '<h1>Valores</h1>';
	foreach ($_POST as $key=>$value)
	{
		$explode = explode("-", $key);
		if ($explode[0] == 'f')
			$sueno->addFilter($explode[1], $value);
	
		echo '<li>'.$explode[1].':'.$value.'</li>';
	}
	echo '<hr>';
	echo '<h1>Resultados</h1>';
	$sueno->calculate();
}
else 
{
?>
   <hr />
    <form action="<?php echo APPLICATION_URL?>prueba-sueno.html" method="post">
        SUEÑO O PROYECTO QUE SE QUIERE REALIZAR <input type="text" name="f-bien" value="AUTOMOVIL" /><br>
        VALOR DEL BIEN QUE DESEA ADQUIRIR <input type="text" name="f-valor_bien" value=" 61900000" /><br>
        VALOR DE LA CUOTA INICIAL <input type="text" name="f-cuota_inicial" value="25000000" /><br>
        VALOR DE UN NUEVO CREDITO <input type="text" name="f-valor_credito" value=" 36900000" /><br>
        A CUANTO TIEMPO LO QUIERE <input type="text" name="f-cuotas" value="70" /><br>
        VALOR DE CUOTA MENSUAL QUE QUIERE PAGAR <input type="text" name="f-costo" value="1000000" /><br>
        INGRESOS NETOS <input type="text" name="f-ingresos_netos" value="3000000" /><br>
        GASTOS MENSUALES DIFERENTES A POR CRÉDITOS <input type="text" name="f-gastos_no_financieros" value="1200000" /><br>
        GASTOS POR CREDITOS SIN INCLUIR COMPRAS A UNA CUOTA CON LA TARJETA DE CREDITO <input type="text" name="f-gastos_financieros" value="0" /><br>
        En cuantos meses piensa realizar su sueño?    <input type="text" name="f-tiempo_sueno" value="0" /><br>
        <input type="submit"> 
    </form>
<?php
}
?>