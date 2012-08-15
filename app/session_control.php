<?php
$getKeys  = array_keys($_GET);
$postKeys = array_keys($_POST);
foreach($getKeys as $getKey)
{
	if($_GET[$getKey] == 'lang')
		$_SESSION['language'] = ($_GET[$getKey + 1] == 1) ? 'esp' : 'eng';
}
foreach($postKeys as $postKey)
{
	if($_POST[$postKey] == 'lang')
		$_SESSION['language'] = ($_POST[$postKey] == 1) ? 'esp' : 'eng';
}
$_SESSION['language'] = (!isset($_SESSION['language'])) ? 'esp' : $_SESSION['language'];
define("LANG", ($_SESSION['language'] == 'esp') ? 1 : 2);
define("LANG_NAME", $_SESSION['language']);
$locale   = (LANG == 1) ? 'es_ES' : 'en';
//setlocale(LC_ALL, $locale);
?>