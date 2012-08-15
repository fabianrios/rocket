<?php
/*header('Content-Type: text/plain; charset=ISO-8859-1');
if(!isset($_GET[2]))
{
	$questionForm = new QuestionForm($_GET[1], $_GET[0]);
	$questionForm->printQuestion();
}
else
{
	$questionForm = new QuestionForm($_GET[1], $_GET[0], $_GET[2], urldecode($_GET[3]));
	$questionForm->printQuestion();	
}*/
$_SESSION['user_id'] = isset($_SESSION["user_id"]) ? $_SESSION['user_id'] : 1;
$user = new User($_SESSION["user_id"]);
$user->__set('user_data', serialize($_POST));
$user->update();
redirectUrl(APPLICATION_URL . 'recomendaciones/' . $_POST['product_id'] . '.html');
?>