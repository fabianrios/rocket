<?php
define ("PATHS", $paths); 
function __autoload($class_name) 
{
	$class_name = strtolower($class_name);
	if(PATHS)
		$classPath = explode(',', PATHS);
	else
		$classPath = array();
		
	foreach($classPath as $prefix)
	{
		$extensions = unserialize(FILE_EXTENSIONS);
		
		$prefix = ($prefix != '') ? $prefix . '/' : '';
		
		
		foreach($extensions as $extension)
		{
			$path = $prefix . $class_name . $extension . '.php';
			if(file_exists($path))
			{
				require_once $path;
				return;
			}
		}
	}  
} 
?>