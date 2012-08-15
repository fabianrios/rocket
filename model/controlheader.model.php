<?php
class ControlHeader
{
	private $user;
	
	public function __construct(ControlUser &$user)
	{
		$this->user = $user;
	}
	
	public function displayIdentifyUser()
	{
		$html = '<div class="identifica">' . $this->user->__get('user_full_name') . ' | <a href="index.php?log_out.control">Cerrar Sesión</a>';

	}
	
	public function displayMenu()
	{
		$principalModules = ModuleHelper::retrieveModules("AND module_parent = 0 AND module_state = 'A' ORDER BY module_order");
		$html  = '<ul id="navmenu">';
		$html .= '	<li><a href="index.php?home.control">Inicio</a></li>';
		foreach($principalModules as $principalModule) 
		{
			$render = PermissionHelper::checkPermission($principalModule->__get('module_system_name') . '_retrieve');
			if($render !== false)
			{	
				$render = ($render != '') ? "index.php?" . $render . '.control' : 'javascript:void(0)'; 
				$extra = '';		
				if(($principalModule->__get('module_content') == 1) || ($principalModule->__get('module_levels') > 0))
					$extra = '/' . $principalModule->__get('module_id');
				if(($principalModule->__get('module_content') == 1) && ($principalModule->__get('module_levels') === '0'))
				{
					$extra  = '';
					$render = 'javascript:void(0);';
				}
				$html .= ' 	<li><a href="' . $render . $extra . '">' . $principalModule->__get('module_name') . '</a>';
				$secondaryModules = ModuleHelper::retrieveModules("AND module_parent = " . $principalModule->__get('module_id') . " AND module_state = 'A' ORDER BY module_order");
				if(count($secondaryModules) > 0)
				{
					$html .= '<ul>';
					foreach($secondaryModules as $secondaryModule)
					{
						$render = PermissionHelper::checkPermission($secondaryModule->__get('module_system_name') . '_retrieve');
						if($render !== false)
						{	
							$render = ($render != '') ? "index.php?" . $render . '.control' : 'javascript:void(0)'; 
							$extra = '';			
							if(($secondaryModule->__get('module_content') == 1) || ($secondaryModule->__get('module_levels') > 0))
								$extra = '/' . $secondaryModule->__get('module_id');		
								
							if(($secondaryModule->__get('module_content') == 1) && ($secondaryModule->__get('module_levels') === '0'))
							{
								$extra  = '';
								$render = 'javascript:void(0);';
							}												
							$html .= ' 	<li><a href="' . $render . $extra . '">' . $secondaryModule->__get('module_name') . '</a>';		
							
							$terciaryModules = ModuleHelper::retrieveModules("AND module_parent = " . $secondaryModule->__get('module_id') . " AND module_state = 'A' ORDER BY module_order");
							
							if(count($terciaryModules) > 0)
							{
							
								$html .= '<ul>';
								foreach($terciaryModules as $terciaryModule)
								{
									$render = PermissionHelper::checkPermission($terciaryModule->__get('module_system_name') . '_retrieve');
									if($render !== false)
									{	
										$extra = '';			
										if(($terciaryModule->__get('module_content') == 1) || ($terciaryModule->__get('module_levels') > 1))
											$extra =  $terciaryModule->__get('module_id');									
										$html .= ' 	<li><a href="index.php?' . $render . '.control/' . $extra . '">' . $terciaryModule->__get('module_name') . '</a></li>';							
									}
								}	
								$html .= '</ul>';
							}					
							$html .= ' 	</li>';
						}
					}
					$html .= '</ul>';					
				}
				$html .= ' 	</li>';
			}
		}	
		$html .= '	<li><a href="index.php?log_out.control">Salir</a></li>';
		$html .= '</ul>';
		
		echo $html;
	}
}
?>