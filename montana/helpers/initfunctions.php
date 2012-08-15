<?php
#initfunctions.php
#processes all the initial requests for the inclusion of the correct page.

function init()		//INITIALIZE ALL FUNCTIONS TO INCLUDE A VALID FILE AND PASS VARS
{	
	$QueryStringValues   = retrieveQueryStringValues(explode('/', QUERY_STRING));
	$getArgs             = $QueryStringValues[1];
	$GLOBALS["GET"]		 = $getArgs;
	$postArgs			 =& $_POST;
	$fileArgs			 =& $_FILES;
	$sessionArgs		 =& $_SESSION;
	$includeToValidate   = ($QueryStringValues[0] != false) ? $QueryStringValues[0] : START_FILE;
	$resolvedIncludePath = resolveIncludePath($includeToValidate); 
	$includeToValidate   = $resolvedIncludePath . $includeToValidate;
	validateInclude($includeToValidate, $getArgs, $postArgs, $fileArgs, $sessionArgs);	
}


function retrieveQueryStringValues($queryStringArray)	//EXAMINE IF THERE'S ANY REQUEST IN THE QUERY STRING 
{
	$queryStringArrayCount = count($queryStringArray);
	if($queryStringArrayCount > 0)
	{
		$args              = array_slice($queryStringArray, 1); 
		$includeToValidate = $queryStringArray[0];
	}
	else
	{
		$args    = array(); 	
		$includeToValidate = false;
	}
	return array($includeToValidate, $args);
}

function resolveIncludePath($include)				//EXAMINE IF THE REQUEST MATCHES TO A DIRECTORY INCLUDED IN THE WEBSITE
{
	$includeBreakOffset  = strrpos($include, '.');
	if($includeBreakOffset === false)
		$includeDir      = "view/";
	else
	{
		$includeDir      = substr($include, ($includeBreakOffset + 1)) . '/';
		if(!is_dir($includeDir))
			$includeDir  = "view/";
			 
	}
	return $includeDir;
}

function validateInclude($includeToValidate, $args = NULL, &$postArgs = NULL, &$fileArgs = NULL, &$sessionArgs = NULL)	 // SEE IF FILE EXISTS
{

	if($includeToValidate)
	{
		if(file_exists($includeToValidate . '.php'))
			$validInclude = $includeToValidate;
		else
			$validInclude = SITE_VIEW . NOT_FOUND_FILE;
	}
	includeFile($validInclude, $args, $postArgs, $fileArgs, $sessionArgs);

}

function includeFile($path, $_GET = NULL, &$_POST = NULL, &$_FILES = NULL, &$_SESSION = NULL) //FINALLY INCLUDE THE FILE
{
	include_once($path . '.php');
}

?>