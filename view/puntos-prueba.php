<?php
$puntos	= PuntoHelper::selectPuntos(" AND city_id = '' ");
while ($punto = mysql_fetch_assoc($puntos['query']))
{
	$punto	= new Punto($punto['punto_id']);
//	$city	= CityHelper::retrieveCities(" AND city_name = '". $punto->__get('punto_ciudad') . "'");
//	if (count($city) != 1)
//		echo $punto->__get('punto_id') . ":" . $punto->__get('punto_ciudad').'<br>';
//	$city	= (count($city) == 1) ? $city[0] : new City;
//	$punto->__set('city_id', $city->__get('city_id'));
	
	
	
	$punto->update();
}








?>