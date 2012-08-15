<?php

function logAll($sender, $args)

{

	$ip       = retrieveClientIp();

	$dateTime = retrieveDate();

	$action   = $args["action"];

	$type	  = $args["type"];

	$user_id  = $args["user_id"];

	

	$logAllSql = "INSERT INTO log_logs (log_ip, log_datetime, user_id, log_module, log_action, log_type) 

				  VALUES ('" . $ip . "', '" . $dateTime . "', " . $user_id . ", '" . get_class($sender) . "', '" . $action . "', " . $type . ")";

	Connection::getInstance();

	$logAllQry = $connection->query($logAllSql);

} 

		

function RegisterEventHandlers($object)

{

	$handlers = defined("EVENT_HANDLERS") ? unserialize(EVENT_HANDLERS) : false;

	if ($handlers)

	  $object->eventHandlers = $handlers;

	else

	  $object->eventHandlers = new EventHandlerCollection();

}



function TriggerEvent($eventName, $args, $object)

{

	$object->eventHandlers->RaiseEvent($eventName, $object, $args);

}



function loadEvents()

{

	$handlers = new EventHandlerCollection();

	include_once(MONTANA_EVENTS_ROOT . "event_list.php");	

	return $handlers;

}



function saveMail()

{

}

?>