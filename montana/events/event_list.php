<?php
if(LOG_INSERT)
{
	$onSave = new Event('OnSave');
	$handlers->Add(new EventHandler($onSave, 'logAll'));
}
if(LOG_UPDATE)
{
	$onUpdate = new Event('OnUpdate');
	$handlers->Add(new EventHandler($onUpdate, 'logAll'));
}
if(LOG_DELETE)
{
	$onDelete = new Event('OnDelete');
	$handlers->Add(new EventHandler($onDelete, 'logAll'));
}
if(LOG_MAIL_SEND)
{
	$onMailSend = new Event('OnMailSend');
	$handlers->Add(new EventHandler($onMailSend, 'logAll'));
}
if(SAVE_MAIL_SEND)
{
	$onMailSend = new Event('OnMailSend');
	$handlers->Add(new EventHandler($onMailSend, 'saveMail'));
}
?>