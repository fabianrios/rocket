<?php
define ("MONTANA_CLASS_PATHS", "montana/classes/,montana/helpers/,montana/interfaces/,"); // Direcciones de clases del montana
define ("MONTANA_FUNCTIONS_PATH", "montana/helpers/functions.php"); // Direccion de funciones de Montana
define ("MONTANA_FCK_FILE", "montana/helpers/fckeditor/fckeditor.php");
define ("MONTANA_FCK_BASE", "montana/helpers/fckeditor/");
define ("MONTANA_EVENTS_LOAD_PATH", "montana/events/init.php"); // Direccion de archivo que carga los eventos
include_once(MONTANA_FUNCTIONS_PATH);
include_once(MONTANA_FCK_FILE);
$paths .= MONTANA_CLASS_PATHS;
?>