<?php
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch($action):
	case 'addIncome':
		$user = new User($_SESSION['user_active']);
		IncomeHelper::deleteIncomes("AND user_id = " . $user->__get('user_id'));

		foreach($_POST as $key => $value)
		{
			if(strpos($key, 'income_name_') !== false)
			{
				if(trim($value) != "")
				{
					$num = str_replace('income_name', '', $key);
					$income = new Income();
					
					foreach($_POST as $key => $value)
					{
						if(strpos($key, $num) !== false)
						{
							echo $key . ' ' . $value . '<br />';
							$income->__set(str_replace($num, '', $key), $value);
						}
					}
					$income->__set('user_id', $user->__get('user_id'));
					$income->save();
				}
			}
		}
		redirectUrl(APPLICATION_URL . "sobres-040.html");
		break;
	case 'delete_income':
		$user 		= new User($_SESSION['user_active']);
		$incomeId 	= escape($_GET[1]);
		IncomeHelper::deleteIncomes("AND user_id = " . $user->__get('user_id') . " AND income_id = '" . $incomeId . "'");
		redirectUrl(APPLICATION_URL . "sobres-020.html");
		break;
endswitch;
?>