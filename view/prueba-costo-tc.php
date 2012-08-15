<?php	
class TCreditosValueCost
{
	var $user;
	
	public function __construct(&$user)
	{
		$this->user = $user;	
	}
	
	public function calculateCost()
	{
		$userData 	= unserialize($this->user->__get('user_data'));
		if (isset($userData['compras-nal-opcion']) && ($userData['compras-nal-opcion'] == 'Si'))
		{
			echo ('aja');
		}
	}
}
$user 	= new User($_SESSION['user_active']);
$tc	 	= new TCreditosValueCost($user);
$tc->calculateCost();


?>