<?php
$controlUser = Security::validateSession();
$header		 = new ControlHeader($controlUser);
require_once(CONTROL_VIEW . "header.php");
?>
