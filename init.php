<?php
session_start();
$time_start = microtime(true);						//START MEASURING EXECUTION TIME
require_once ("config/config.php"); 				//INCLUDE CONFIGURATION INIT
foreach(explode(',', DEPENDENCES) as $dependence)	//INCLUDE DEPENDENCES	 
	require_once($dependence.'/init.php');
require_once ("autoload.php"); 						//AUTOLOAD	
if (DEBUG)
{
	$GLOBALS["queries"]	= '';
	$GLOBALS["database_initialization"] = 0;
}
define ("QUERY_STRING", isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '');	//DEFINE QUERY STRING 
init();												//INIT THE APPLICATION
$time_end = microtime(true);						//END MEASURING EXECUTION TIME
if (DEBUG)											//INCLUDE DEBUG REPORT
	require_once('montana/helpers/debug.php');
?>