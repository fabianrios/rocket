<?php
header('Content-Type: text/html; charset=iso-8859-1');
$action = isset($_POST['action']) ? $_POST['action'] : $_GET[0];
switch($action):
	case 'createExpense':
		$envelopeBag = new EnvelopeBag();
		$envelopeBag->__set('user_id', escape($_POST['user_id']));
		$envelopeBag->__set('envelope_bag_name', escape(utf8_decode($_POST['envelope_item_name'])));
		$envelopeBag->__set('user_envelope_id', escape($_POST['user_envelope_id']));
		$envelopeBagResult = $envelopeBag->save();
		
		$envelopeItem = new EnvelopeItem();
		foreach($_POST as $key => $value)
			$envelopeItem->__set($key, $value);
		if(intval($_POST["envelope_item_save_since"]) > 0)
			$envelopeItem->__set('envelope_item_save', 1);
		else
			$envelopeItem->__set('envelope_item_save', 0);
		
		$envelopeItem->__set('envelope_item_payday', date('Y-m-d', strtotime($_POST['envelope_item_payday'])));
		
		$envelopeItem->__set('envelope_item_value', str_replace('.', '', $_POST['envelope_item_value']));
		$envelopeItem->__set('envelope_bag_id', $envelopeBagResult["insert_id"]);
		$envelopeItem->__set('envelope_item_last_log_date', date('Y-m-d', strtotime(date('Y-m-d') . '-1 day')));
		$envelopeItem->__set('envelope_item_status', 1);
		$envelopeItem->save();
		
		$userEnvelope 	= new UserEnvelope($_POST['user_envelope_id']);
		$user			= new User($_POST['user_id']);
		
		require_once(SITE_VIEW . "expenses_div.php");
		
		break;
endswitch;
?>