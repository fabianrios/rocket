<?php
class ModuleHelper
{
	public static function selectModules ( $extra = "", $extraTables = ""   )
	{
		$connection = Connection::getInstance();
		$retrieveModulesSql    = "SELECT module_id
							         FROM core_modules" . $extraTables . "
								     WHERE module_state <> 'D'
								     " . $extra;
		return $connection->query($retrieveModulesSql);		
	}
	public static function retrieveModules ( $extra  = "", $extraTables = ""  )
	{
		$modules = array();
		
		$retrieveModulesResult = self::selectModules ( $extra, $extraTables  );
		
		while($moduleRow = mysql_fetch_assoc($retrieveModulesResult["query"]))
			$modules[] = new Module($moduleRow["module_id"]);
			
		return $modules;
	}
	public static function dumpAllModules($modules) 
	{
		if (count($modules) > 0) {
			echo '<ul>';
			foreach ($modules as $module) 
			{
				$url 			= 'index.php?module_expand.control/'.$module->__get('module_id');
				$filter 		= " AND module_parent = ".$module->__get('module_id') . " ORDER BY module_order";
				$next_modules 	= ModuleHelper::retrieveModules($filter);
				$image 			= (count($next_modules) > 0) ?  "imgcontrol/ico_tree.gif" : "imgcontrol/ico_page.gif";
 				echo "
					<li><a href=\"".$url."\" class=\"sidebar_02\">
						<img src=\"".$image."\" />
						<span>".$module->__get('module_name')."</span>
						</a>";
						if (count($next_modules) > 0) self::dumpAllModules($next_modules);			
				echo "</li>";
			}
			echo '</ul>';
		}	
	}
	public static function dumpBreadCrums($module_id)
	{
		$breadCrums = '<a href="index.php?home.control">Inicio</a> &gt; <a href="index.php?module_list.control">Modulos</a>';
		$breadString = '';
		if ($module_id != 0) 
		{
			$has_parent = true;
			$parents 	= array();
			while ($has_parent == true)
			{
				$module = new Module($module_id);
				$parents[] = $module; 
				if ($module->__get('module_parent') != 0)
				{
					$module_id = $module->__get('module_parent');
				}
				else
					$has_parent = false;
			}
			foreach ($parents as $parent)
			{
				$breadString = '&gt; <a href="index.php?module_list.control/'.$parent->__get('module_id').'">'.$parent->__get('module_name').'</a>' . $breadString; 
			}
		}	
		$breadCrums = $breadCrums . $breadString;
		return $breadCrums;	
	}
}
?>