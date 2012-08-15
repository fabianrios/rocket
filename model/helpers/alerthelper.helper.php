<?php
class AlertHelper
{
	public static function placeAlerts($alerts)
	{
		if (count($alerts) > 0) 
		{
			foreach ($alerts as $alert)
			{
				if ($alert['type'] == 'error')
					$class = 'aviso01';
				elseif ($alert['type'] == 'warning')
					$class = 'aviso02';
				else
					$class = 'aviso03';
				echo "<div class=\"aviso00 " . $class . "\">".$alert['msg']."</div>";
			}	
		}
	}
}