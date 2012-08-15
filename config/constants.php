<?php
//CONFIG
define ("TESTMODE", true);				//CONFIGURED FOR STAGING OR PRODUCTION
define ("DEBUG", true);		
define ("DEBUG_VISIBLE", true);		// ?
define ("APPLICATION_LOCALE", "es");	// SET APPLICATION LOCALE 
define ("APPLICATION_NAME", "Rocket"); 	//APPLICATION NAME
//FILES & DIRECTORIES //
define ("DEPENDENCES", "montana,view,model");		//DEPENDENCES	
define ("NOT_FOUND_FILE", "404"); 		// ?
define ("FILE_EXTENSIONS", serialize(array("", ".class", ".model", ".controller", ".inter",".helper")));
define ("START_FILE", "home");
define ("INIT_FILE", "index.php");
//DATABASE//
if (TESTMODE) 
{
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 'On');
	ini_set('display_startup_errors', 'On');
	ini_set('memory_limit', '250M'); 
	
	define ("APPLICATION_URL", "/buho_private/"); 
	define ("APPLICATION_FULL_URL", "http://190.145.56.83/buho_private/"); 
	define ("APPLICATION_HOST_URL", "http://190.145.56.83/");
	//LOCALHOST
	define ("DB_NAME", "staging");
	define ("DB_HOST", "107.20.228.20"); 
	define ("DB_USER", "buho_user"); 
	define ("DB_PASSWORD", "buh0pass$1");
}
else 
{
 	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('display_startup_errors', 'Off');
	ini_set('memory_limit', '250M'); 
	
	define ("APPLICATION_URL", "/staging/"); 
	define ("APPLICATION_FULL_URL", "http://www.rocket.com.co/staging/"); 
	//LOCALHOST
	define ("DB_NAME", "staging"); 
	define ("DB_HOST", "localhost"); 
	define ("DB_USER", "buho_user"); 
	define ("DB_PASSWORD", "buh0pass"); 
}
//ERROR PAGES
define ("APPLICATION_404", APPLICATION_URL);
//LOCALES
define ("APPLICATION_DATE_FORMAT", "%Y-%m-%d %H:%M:%S"); 
//SISTEMA
define ("SMMLV", 566700); 
?>
