<?php
if (isset($_POST['f-valor_credito']))
{
	foreach ($_POST as $key=>$value)
		echo $key.':'.$value.'<br>';
	echo '<h1>Resultados</h1>';
	echo Sueno::calculatePayment($_POST['f-valor_credito'], $_POST['f-cuotas'], $_POST['f-pago']);
}

?>
   <hr />
    <form action="<?php echo APPLICATION_URL?>prueba-sueno-cuotas.html" method="post">
        VALOR DE UN NUEVO CREDITO <input type="text" name="f-valor_credito" value="36900000" /><br>
        CUOTAS <input type="text" name="f-cuotas" value="0" /><br>
        Valor mes <input type="text" name="f-pago" value="0" /><br>
        <input type="submit"> 
    </form>
<?php

?>