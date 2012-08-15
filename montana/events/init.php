<?php
if(function_exists("loadEvents"))
{
	$handlers = loadEvents();
	define ("EVENT_HANDLERS", serialize($handlers));
}
else
	die('Error: la function loadEvents() no existe');
?>