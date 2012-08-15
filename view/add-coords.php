<?php
$connection  = Connection::getInstance();
$sql	= 'SELECT municipio_nombre, direccion_id, CONCAT(ugeo_vias.via_nombre, " ", direccion_numero, direccion_letra, " ", direccion_2_numero, direccion_2_letra) as dirr 
FROM ugeo_vias, ugeo_oficinas_direcciones, ugeo_oficinas, ugeo_municipios
WHERE ugeo_vias.via_id = direccion_via_1_id
AND ugeo_oficinas.oficina_codigo = ugeo_oficinas_direcciones.direccion_oficina_id 
AND ugeo_oficinas.oficina_municipio_id = ugeo_municipios.municipio_id GROUP BY direccion_id LIMIT 3410, 300';
$result  = $connection->query($sql);

$found 	= 0;
$nfound	= 0;
while ($row = mysql_fetch_assoc($result['query']))
{
	$resolveTo1	= ColombiaHelper::selectPoints(" AND cityname = '".$row['municipio_nombre']."' AND name = '".$row['dirr']."'");
	if ($resolveTo1['num_rows'] > 0)
	{
		$sql 		= "UPDATE ugeo_oficinas_direcciones SET direccion_coord_lat = ".mysql_result($resolveTo1['query'], 0, 1).", direccion_coord_lon = ".mysql_result($resolveTo1['query'], 0, 2)."   WHERE direccion_id = '".$row['direccion_id']."'";
		$update  	= $connection->query($sql);
		$found++;
	}
	else
		$nfound++;
}
echo $found.'<br>';
echo $nfound;

?>