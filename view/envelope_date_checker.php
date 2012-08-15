<?php
if($userEnvelope->__get('user_envelope_periodicity') != "")
{
	switch($userEnvelope->__get('user_envelope_periodicity')):
		case 7:
			$addValue = "+7 days";
			break;
		case 15:
			$addValue = "+15 days";
			break;
		case 30:
			$addValue = "+1 month";
			break;
		case 60:
			$addValue = "+2 moths";
			break;
		case 180:
			$addValue = "+6 months";
			break;
		case 360:
			$addValue = "+1 year";
			break;
	endswitch;

	if(strtotime($userEnvelope->__get('user_envelope_date') . $addValue) < strtotime(date("Y-m-d")))
	{
		$currentDate	= date('Y-m-d');
		$foundDate 		= false;
		$envelopeDate	= $userEnvelope->__get('user_envelope_date');
		while(!$foundDate)
		{
			if(strtotime($envelopeDate . " +" . $userEnvelope->__get('user_envelope_periodicity') . " days") > strtotime($currentDate))
				$foundDate = true;
			else
				$envelopeDate = date("Y-m-d", strtotime($envelopeDate . "+" . $userEnvelope->__get('user_envelope_periodicity') . " days"));
			
		}
		$userEnvelope->__set('user_envelope_date', $envelopeDate);
		$userEnvelopeResult = $userEnvelope->save();
		$userEnvelope->__set('user_envelope_id', $userEnvelopeResult['insert_id']);
	}
}
?>